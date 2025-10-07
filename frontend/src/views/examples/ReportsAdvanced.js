/*!
=========================================================
* TicomSys - Sistema de Gestión de Reparaciones
=========================================================
* Sistema de Reportes Avanzados
=========================================================
*/

import React, { useState, useEffect } from "react";
// reactstrap components
import {
  Card,
  CardHeader,
  CardBody,
  Container,
  Row,
  Col,
  Button,
  Form,
  FormGroup,
  Label,
  Input,
  Table,
  Badge,
  UncontrolledAlert,
  Nav,
  NavItem,
  NavLink,
  TabContent,
  TabPane
} from "reactstrap";
// Chart.js components
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  BarElement,
  LineElement,
  PointElement,
  Title,
  Tooltip,
  Legend,
  ArcElement
} from 'chart.js';
import { Bar, Line, Doughnut } from 'react-chartjs-2';

// Register Chart.js components
ChartJS.register(
  CategoryScale,
  LinearScale,
  BarElement,
  LineElement,
  PointElement,
  Title,
  Tooltip,
  Legend,
  ArcElement
);

const ReportsAdvanced = () => {
  const [activeTab, setActiveTab] = useState('1');
  const [loading, setLoading] = useState(false);
  const [alert, setAlert] = useState({ show: false, message: '', color: 'success' });
  const [dateRange, setDateRange] = useState({
    date_from: new Date(new Date().getFullYear(), new Date().getMonth(), 1).toISOString().split('T')[0],
    date_to: new Date().toISOString().split('T')[0]
  });
  
  // Report data states
  const [equipmentByStatus, setEquipmentByStatus] = useState(null);
  const [revenueByPeriod, setRevenueByPeriod] = useState(null);
  const [technicianProductivity, setTechnicianProductivity] = useState(null);
  const [mostRepairedEquipment, setMostRepairedEquipment] = useState(null);
  const [averageRepairTime, setAverageRepairTime] = useState(null);
  const [financialReport, setFinancialReport] = useState(null);
  const [dashboardStats, setDashboardStats] = useState(null);

  useEffect(() => {
    loadDashboardStats();
  }, []);

  const showAlert = (message, color = 'success') => {
    setAlert({ show: true, message, color });
    setTimeout(() => setAlert({ show: false, message: '', color: 'success' }), 5000);
  };

  const loadReport = async (reportType, setDataFunction) => {
    setLoading(true);
    try {
      const params = new URLSearchParams(dateRange);
      const response = await fetch(`/api/reports/${reportType}?${params}`, {
        credentials: 'include',
        headers: {
          'Accept': 'application/json',
        }
      });

      if (response.ok) {
        const data = await response.json();
        setDataFunction(data);
      } else {
        showAlert('Error al cargar el reporte', 'danger');
      }
    } catch (error) {
      console.error('Error loading report:', error);
      showAlert('Error al cargar el reporte', 'danger');
    }
    setLoading(false);
  };

  const loadDashboardStats = async () => {
    try {
      const response = await fetch('/api/reports/dashboard-stats', {
        credentials: 'include',
        headers: {
          'Accept': 'application/json',
        }
      });

      if (response.ok) {
        const data = await response.json();
        setDashboardStats(data);
      }
    } catch (error) {
      console.error('Error loading dashboard stats:', error);
    }
  };

  const handleDateRangeChange = (field, value) => {
    setDateRange(prev => ({
      ...prev,
      [field]: value
    }));
  };

  const formatCurrency = (amount) => {
    return new Intl.NumberFormat('es-MX', {
      style: 'currency',
      currency: 'MXN'
    }).format(amount);
  };

  const formatDate = (date) => {
    return new Date(date).toLocaleDateString('es-MX');
  };

  // Chart configurations
  const getEquipmentByStatusChart = () => {
    if (!equipmentByStatus) return null;

    const data = {
      labels: equipmentByStatus.data.map(item => item.status),
      datasets: [
        {
          label: 'Cantidad de Equipos',
          data: equipmentByStatus.data.map(item => item.count),
          backgroundColor: [
            '#FF6384',
            '#36A2EB',
            '#FFCE56',
            '#4BC0C0',
            '#9966FF',
            '#FF9F40',
            '#FF6384'
          ],
          borderWidth: 1
        }
      ]
    };

    const options = {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: equipmentByStatus.title
        }
      }
    };

    return <Doughnut data={data} options={options} />;
  };

  const getRevenueChart = () => {
    if (!revenueByPeriod) return null;

    const data = {
      labels: revenueByPeriod.data.map(item => formatDate(item.date)),
      datasets: [
        {
          label: 'Ingresos Diarios',
          data: revenueByPeriod.data.map(item => item.total),
          borderColor: 'rgb(75, 192, 192)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          tension: 0.1
        }
      ]
    };

    const options = {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: revenueByPeriod.title
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return formatCurrency(value);
            }
          }
        }
      }
    };

    return <Line data={data} options={options} />;
  };

  const getTechnicianProductivityChart = () => {
    if (!technicianProductivity) return null;

    const data = {
      labels: technicianProductivity.data.map(item => item.technician_name),
      datasets: [
        {
          label: 'Equipos Completados',
          data: technicianProductivity.data.map(item => item.completed_equipment),
          backgroundColor: 'rgba(54, 162, 235, 0.8)',
        },
        {
          label: 'Tickets Completados',
          data: technicianProductivity.data.map(item => item.completed_tickets),
          backgroundColor: 'rgba(255, 99, 132, 0.8)',
        }
      ]
    };

    const options = {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: technicianProductivity.title
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    };

    return <Bar data={data} options={options} />;
  };

  return (
    <>
      <Container className="mt--7" fluid>
        {/* Header */}
        <Row>
          <div className="col">
            <div className="header-body">
              <div className="row align-items-center py-4">
                <div className="col-lg-6 col-7">
                  <h6 className="h2 text-white d-inline-block mb-0">Reportes Avanzados</h6>
                  <nav aria-label="breadcrumb" className="d-none d-md-inline-block ml-md-4">
                    <ol className="breadcrumb breadcrumb-links breadcrumb-dark">
                      <li className="breadcrumb-item">
                        <a href="#pablo" onClick={(e) => e.preventDefault()}>
                          <i className="fas fa-home" />
                        </a>
                      </li>
                      <li className="breadcrumb-item">
                        <a href="#pablo" onClick={(e) => e.preventDefault()}>
                          Reportes
                        </a>
                      </li>
                      <li className="breadcrumb-item active" aria-current="page">
                        Reportes Avanzados
                      </li>
                    </ol>
                  </nav>
                </div>
                <div className="col-lg-6 col-5 text-right">
                  <Button
                    color="primary"
                    onClick={() => window.print()}
                    size="sm"
                  >
                    <i className="fas fa-print"></i> Imprimir Reportes
                  </Button>
                </div>
              </div>
            </div>
          </div>
        </Row>

        {/* Alert */}
        {alert.show && (
          <UncontrolledAlert color={alert.color} fade={false}>
            {alert.message}
          </UncontrolledAlert>
        )}

        {/* Date Range Filter */}
        <Row>
          <div className="col">
            <Card className="shadow">
              <CardHeader className="border-0">
                <h3 className="mb-0">Filtros de Fecha</h3>
              </CardHeader>
              <CardBody>
                <Row>
                  <Col md="4">
                    <FormGroup>
                      <Label>Fecha Desde</Label>
                      <Input
                        type="date"
                        value={dateRange.date_from}
                        onChange={(e) => handleDateRangeChange('date_from', e.target.value)}
                      />
                    </FormGroup>
                  </Col>
                  <Col md="4">
                    <FormGroup>
                      <Label>Fecha Hasta</Label>
                      <Input
                        type="date"
                        value={dateRange.date_to}
                        onChange={(e) => handleDateRangeChange('date_to', e.target.value)}
                      />
                    </FormGroup>
                  </Col>
                  <Col md="4" className="d-flex align-items-end">
                    <Button
                      color="primary"
                      onClick={() => {
                        loadReport('equipment-by-status', setEquipmentByStatus);
                        loadReport('revenue-by-period', setRevenueByPeriod);
                        loadReport('technician-productivity', setTechnicianProductivity);
                        loadReport('most-repaired-equipment', setMostRepairedEquipment);
                        loadReport('average-repair-time', setAverageRepairTime);
                        loadReport('financial-report', setFinancialReport);
                      }}
                      disabled={loading}
                    >
                      {loading ? 'Cargando...' : 'Actualizar Reportes'}
                    </Button>
                  </Col>
                </Row>
              </CardBody>
            </Card>
          </div>
        </Row>

        {/* Dashboard Stats */}
        {dashboardStats && (
          <Row>
            <div className="col">
              <Card className="shadow">
                <CardHeader className="border-0">
                  <h3 className="mb-0">Estadísticas del Mes Actual</h3>
                </CardHeader>
                <CardBody>
                  <Row>
                    <Col md="2">
                      <div className="text-center">
                        <h4 className="text-primary">{dashboardStats.current_month.equipment_received}</h4>
                        <small className="text-muted">Equipos Recibidos</small>
                        <div className={`text-${dashboardStats.changes_percentage.equipment_received >= 0 ? 'success' : 'danger'}`}>
                          <small>{dashboardStats.changes_percentage.equipment_received >= 0 ? '+' : ''}{dashboardStats.changes_percentage.equipment_received}%</small>
                        </div>
                      </div>
                    </Col>
                    <Col md="2">
                      <div className="text-center">
                        <h4 className="text-success">{dashboardStats.current_month.equipment_delivered}</h4>
                        <small className="text-muted">Equipos Entregados</small>
                        <div className={`text-${dashboardStats.changes_percentage.equipment_delivered >= 0 ? 'success' : 'danger'}`}>
                          <small>{dashboardStats.changes_percentage.equipment_delivered >= 0 ? '+' : ''}{dashboardStats.changes_percentage.equipment_delivered}%</small>
                        </div>
                      </div>
                    </Col>
                    <Col md="2">
                      <div className="text-center">
                        <h4 className="text-info">{dashboardStats.current_month.tickets_created}</h4>
                        <small className="text-muted">Tickets Creados</small>
                        <div className={`text-${dashboardStats.changes_percentage.tickets_created >= 0 ? 'success' : 'danger'}`}>
                          <small>{dashboardStats.changes_percentage.tickets_created >= 0 ? '+' : ''}{dashboardStats.changes_percentage.tickets_created}%</small>
                        </div>
                      </div>
                    </Col>
                    <Col md="2">
                      <div className="text-center">
                        <h4 className="text-warning">{dashboardStats.current_month.tickets_closed}</h4>
                        <small className="text-muted">Tickets Cerrados</small>
                        <div className={`text-${dashboardStats.changes_percentage.tickets_closed >= 0 ? 'success' : 'danger'}`}>
                          <small>{dashboardStats.changes_percentage.tickets_closed >= 0 ? '+' : ''}{dashboardStats.changes_percentage.tickets_closed}%</small>
                        </div>
                      </div>
                    </Col>
                    <Col md="2">
                      <div className="text-center">
                        <h4 className="text-primary">{dashboardStats.current_month.invoices_created}</h4>
                        <small className="text-muted">Facturas Creadas</small>
                        <div className={`text-${dashboardStats.changes_percentage.invoices_created >= 0 ? 'success' : 'danger'}`}>
                          <small>{dashboardStats.changes_percentage.invoices_created >= 0 ? '+' : ''}{dashboardStats.changes_percentage.invoices_created}%</small>
                        </div>
                      </div>
                    </Col>
                    <Col md="2">
                      <div className="text-center">
                        <h4 className="text-success">{formatCurrency(dashboardStats.current_month.revenue)}</h4>
                        <small className="text-muted">Ingresos</small>
                        <div className={`text-${dashboardStats.changes_percentage.revenue >= 0 ? 'success' : 'danger'}`}>
                          <small>{dashboardStats.changes_percentage.revenue >= 0 ? '+' : ''}{dashboardStats.changes_percentage.revenue}%</small>
                        </div>
                      </div>
                    </Col>
                  </Row>
                </CardBody>
              </Card>
            </div>
          </Row>
        )}

        {/* Reports Tabs */}
        <Row>
          <div className="col">
            <Card className="shadow">
              <CardHeader className="border-0">
                <Nav tabs>
                  <NavItem>
                    <NavLink
                      className={activeTab === '1' ? 'active' : ''}
                      onClick={() => setActiveTab('1')}
                      style={{ cursor: 'pointer' }}
                    >
                      Equipos por Estado
                    </NavLink>
                  </NavItem>
                  <NavItem>
                    <NavLink
                      className={activeTab === '2' ? 'active' : ''}
                      onClick={() => setActiveTab('2')}
                      style={{ cursor: 'pointer' }}
                    >
                      Ingresos
                    </NavLink>
                  </NavItem>
                  <NavItem>
                    <NavLink
                      className={activeTab === '3' ? 'active' : ''}
                      onClick={() => setActiveTab('3')}
                      style={{ cursor: 'pointer' }}
                    >
                      Productividad
                    </NavLink>
                  </NavItem>
                  <NavItem>
                    <NavLink
                      className={activeTab === '4' ? 'active' : ''}
                      onClick={() => setActiveTab('4')}
                      style={{ cursor: 'pointer' }}
                    >
                      Equipos Más Reparados
                    </NavLink>
                  </NavItem>
                  <NavItem>
                    <NavLink
                      className={activeTab === '5' ? 'active' : ''}
                      onClick={() => setActiveTab('5')}
                      style={{ cursor: 'pointer' }}
                    >
                      Tiempos de Reparación
                    </NavLink>
                  </NavItem>
                  <NavItem>
                    <NavLink
                      className={activeTab === '6' ? 'active' : ''}
                      onClick={() => setActiveTab('6')}
                      style={{ cursor: 'pointer' }}
                    >
                      Reporte Financiero
                    </NavLink>
                  </NavItem>
                </Nav>
              </CardHeader>
              <CardBody>
                <TabContent activeTab={activeTab}>
                  {/* Tab 1: Equipment by Status */}
                  <TabPane tabId="1">
                    {equipmentByStatus ? (
                      <div>
                        <Row>
                          <Col md="6">
                            {getEquipmentByStatusChart()}
                          </Col>
                          <Col md="6">
                            <h5>{equipmentByStatus.title}</h5>
                            <p className="text-muted">{equipmentByStatus.period}</p>
                            <Table size="sm">
                              <thead>
                                <tr>
                                  <th>Estado</th>
                                  <th>Cantidad</th>
                                  <th>Porcentaje</th>
                                </tr>
                              </thead>
                              <tbody>
                                {equipmentByStatus.data.map((item, index) => (
                                  <tr key={index}>
                                    <td>{item.status}</td>
                                    <td>{item.count}</td>
                                    <td>{((item.count / equipmentByStatus.total) * 100).toFixed(1)}%</td>
                                  </tr>
                                ))}
                              </tbody>
                            </Table>
                            <p><strong>Total: {equipmentByStatus.total} equipos</strong></p>
                          </Col>
                        </Row>
                      </div>
                    ) : (
                      <div className="text-center">
                        <p>Haz clic en "Actualizar Reportes" para cargar los datos</p>
                      </div>
                    )}
                  </TabPane>

                  {/* Tab 2: Revenue */}
                  <TabPane tabId="2">
                    {revenueByPeriod ? (
                      <div>
                        <Row>
                          <Col md="8">
                            {getRevenueChart()}
                          </Col>
                          <Col md="4">
                            <h5>{revenueByPeriod.title}</h5>
                            <p className="text-muted">{revenueByPeriod.period}</p>
                            <div className="mt-4">
                              <p><strong>Ingresos Totales:</strong> {formatCurrency(revenueByPeriod.summary.total_revenue)}</p>
                              <p><strong>Promedio Diario:</strong> {formatCurrency(revenueByPeriod.summary.average_daily)}</p>
                              <p><strong>Total de Facturas:</strong> {revenueByPeriod.summary.total_invoices}</p>
                            </div>
                          </Col>
                        </Row>
                      </div>
                    ) : (
                      <div className="text-center">
                        <p>Haz clic en "Actualizar Reportes" para cargar los datos</p>
                      </div>
                    )}
                  </TabPane>

                  {/* Tab 3: Technician Productivity */}
                  <TabPane tabId="3">
                    {technicianProductivity ? (
                      <div>
                        <Row>
                          <Col md="8">
                            {getTechnicianProductivityChart()}
                          </Col>
                          <Col md="4">
                            <h5>{technicianProductivity.title}</h5>
                            <p className="text-muted">{technicianProductivity.period}</p>
                            <div className="mt-4">
                              <p><strong>Total Técnicos:</strong> {technicianProductivity.summary.total_technicians}</p>
                              <p><strong>Equipos Completados:</strong> {technicianProductivity.summary.total_equipment_completed}</p>
                              <p><strong>Tickets Completados:</strong> {technicianProductivity.summary.total_tickets_completed}</p>
                            </div>
                          </Col>
                        </Row>
                      </div>
                    ) : (
                      <div className="text-center">
                        <p>Haz clic en "Actualizar Reportes" para cargar los datos</p>
                      </div>
                    )}
                  </TabPane>

                  {/* Tab 4: Most Repaired Equipment */}
                  <TabPane tabId="4">
                    {mostRepairedEquipment ? (
                      <div>
                        <h5>{mostRepairedEquipment.title}</h5>
                        <p className="text-muted">{mostRepairedEquipment.period}</p>
                        <Table>
                          <thead>
                            <tr>
                              <th>Equipo</th>
                              <th>Tipo</th>
                              <th>Veces Reparado</th>
                            </tr>
                          </thead>
                          <tbody>
                            {mostRepairedEquipment.data.map((item, index) => (
                              <tr key={index}>
                                <td>{item.equipment}</td>
                                <td>{item.type}</td>
                                <td>
                                  <Badge color="primary">{item.count}</Badge>
                                </td>
                              </tr>
                            ))}
                          </tbody>
                        </Table>
                        <p><strong>Total de equipos únicos: {mostRepairedEquipment.summary.unique_models}</strong></p>
                      </div>
                    ) : (
                      <div className="text-center">
                        <p>Haz clic en "Actualizar Reportes" para cargar los datos</p>
                      </div>
                    )}
                  </TabPane>

                  {/* Tab 5: Average Repair Time */}
                  <TabPane tabId="5">
                    {averageRepairTime ? (
                      <div>
                        <h5>{averageRepairTime.title}</h5>
                        <p className="text-muted">{averageRepairTime.period}</p>
                        <Row>
                          <Col md="6">
                            <h6>Resumen General</h6>
                            <p><strong>Tiempo Promedio:</strong> {averageRepairTime.data.overall.average_days} días</p>
                            <p><strong>Tiempo Mínimo:</strong> {averageRepairTime.data.overall.min_days} días</p>
                            <p><strong>Tiempo Máximo:</strong> {averageRepairTime.data.overall.max_days} días</p>
                            <p><strong>Total Entregados:</strong> {averageRepairTime.data.overall.total_delivered}</p>
                          </Col>
                          <Col md="6">
                            <h6>Tiempo por Estado</h6>
                            <Table size="sm">
                              <thead>
                                <tr>
                                  <th>Estado</th>
                                  <th>Promedio (horas)</th>
                                </tr>
                              </thead>
                              <tbody>
                                {averageRepairTime.data.by_status.map((item, index) => (
                                  <tr key={index}>
                                    <td>{item.status}</td>
                                    <td>{item.average_hours}</td>
                                  </tr>
                                ))}
                              </tbody>
                            </Table>
                          </Col>
                        </Row>
                      </div>
                    ) : (
                      <div className="text-center">
                        <p>Haz clic en "Actualizar Reportes" para cargar los datos</p>
                      </div>
                    )}
                  </TabPane>

                  {/* Tab 6: Financial Report */}
                  <TabPane tabId="6">
                    {financialReport ? (
                      <div>
                        <h5>{financialReport.title}</h5>
                        <p className="text-muted">{financialReport.period}</p>
                        <Row>
                          <Col md="6">
                            <h6>Resumen Financiero</h6>
                            <p><strong>Total Facturado:</strong> {formatCurrency(financialReport.data.summary.total_invoiced)}</p>
                            <p><strong>Total Pagado:</strong> {formatCurrency(financialReport.data.summary.total_paid)}</p>
                            <p><strong>Total Pendiente:</strong> {formatCurrency(financialReport.data.summary.total_pending)}</p>
                            <p><strong>Total Vencido:</strong> {formatCurrency(financialReport.data.summary.total_overdue)}</p>
                            <p><strong>% de Cobranza:</strong> {financialReport.data.summary.collection_rate}%</p>
                          </Col>
                          <Col md="6">
                            <h6>Facturas por Estado</h6>
                            <Table size="sm">
                              <thead>
                                <tr>
                                  <th>Estado</th>
                                  <th>Cantidad</th>
                                  <th>Total</th>
                                </tr>
                              </thead>
                              <tbody>
                                {financialReport.data.by_status.map((item, index) => (
                                  <tr key={index}>
                                    <td>
                                      <Badge color={
                                        item.status === 'paid' ? 'success' :
                                        item.status === 'sent' ? 'info' :
                                        item.status === 'overdue' ? 'danger' : 'secondary'
                                      }>
                                        {item.status}
                                      </Badge>
                                    </td>
                                    <td>{item.count}</td>
                                    <td>{formatCurrency(item.total)}</td>
                                  </tr>
                                ))}
                              </tbody>
                            </Table>
                          </Col>
                        </Row>
                      </div>
                    ) : (
                      <div className="text-center">
                        <p>Haz clic en "Actualizar Reportes" para cargar los datos</p>
                      </div>
                    )}
                  </TabPane>
                </TabContent>
              </CardBody>
            </Card>
          </div>
        </Row>
      </Container>
    </>
  );
};

export default ReportsAdvanced;






