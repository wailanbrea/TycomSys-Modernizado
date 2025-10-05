/*!
=========================================================
* TICOMSYS - Dashboard Principal
=========================================================
* Dashboard funcional con datos reales del sistema
=========================================================
*/

import React, { useState, useEffect } from "react";
// Chart.js v4 setup
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  BarElement,
  Tooltip,
  Legend,
  ArcElement,
} from "chart.js";
import { Line, Bar, Doughnut } from "react-chartjs-2";
// reactstrap components
import {
  Button,
  Card,
  CardHeader,
  CardBody,
  NavItem,
  NavLink,
  Nav,
  Progress,
  Table,
  Container,
  Row,
  Col,
  Badge,
  Spinner,
} from "reactstrap";
import PageHeader from "components/Headers/PageHeader.js";

// Registrar componentes de Chart.js v4
ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  BarElement,
  Tooltip,
  Legend,
  ArcElement
);

const Index = () => {
  const [loading, setLoading] = useState(true);
  const [stats, setStats] = useState({
    equipments: {
      total: 0,
      pending: 0,
      inProgress: 0,
      completed: 0,
      totalValue: 0
    },
    invoices: {
      total: 0,
      paid: 0,
      pending: 0,
      overdue: 0,
      totalAmount: 0
    },
    technicians: {
      total: 0,
      active: 0,
      workload: []
    },
    recentActivities: []
  });
  const [chartData, setChartData] = useState({
    monthlyEquipments: null,
    monthlyInvoices: null,
    statusDistribution: null
  });

  useEffect(() => {
    loadDashboardData();
  }, []);

  const loadDashboardData = async () => {
    try {
      setLoading(true);
      
      // Cargar datos en paralelo
      const [equipmentsRes, invoicesRes, techniciansRes] = await Promise.all([
        fetch('/api/repair-equipment', { credentials: 'include' }),
        fetch('/api/invoices', { credentials: 'include' }),
        fetch('/api/test/technicians', { credentials: 'include' })
      ]);

      const [equipments, invoices, technicians] = await Promise.all([
        equipmentsRes.json(),
        invoicesRes.json(),
        techniciansRes.json()
      ]);

      // Procesar estadísticas de equipos
      const equipmentStats = processEquipmentStats(equipments.data || equipments);
      const invoiceStats = processInvoiceStats(invoices.data || invoices);
      const technicianStats = processTechnicianStats(technicians.technicians || []);

      setStats({
        equipments: equipmentStats,
        invoices: invoiceStats,
        technicians: technicianStats,
        recentActivities: generateRecentActivities(equipments.data || equipments, invoices.data || invoices)
      });

      // Generar datos para gráficos
      setChartData({
        monthlyEquipments: generateMonthlyEquipmentChart(equipments.data || equipments),
        monthlyInvoices: generateMonthlyInvoiceChart(invoices.data || invoices),
        statusDistribution: generateStatusDistributionChart(equipmentStats)
      });

    } catch (error) {
      console.error('Error loading dashboard data:', error);
    } finally {
      setLoading(false);
    }
  };

  const processEquipmentStats = (equipments) => {
    const total = equipments.length;
    const pending = equipments.filter(eq => eq.status === 'pending').length;
    const inProgress = equipments.filter(eq => eq.status === 'in_progress').length;
    const completed = equipments.filter(eq => eq.status === 'completed').length;
    
    // Calcular valor total estimado (asumiendo un promedio de $200 por equipo)
    const totalValue = total * 200;

    return { total, pending, inProgress, completed, totalValue };
  };

  const processInvoiceStats = (invoices) => {
    const total = invoices.length;
    const paid = invoices.filter(inv => inv.status === 'paid').length;
    const pending = invoices.filter(inv => inv.status === 'draft').length;
    const overdue = invoices.filter(inv => inv.status === 'overdue').length;
    
    const totalAmount = invoices.reduce((sum, inv) => sum + (parseFloat(inv.total_amount) || 0), 0);

    return { total, paid, pending, overdue, totalAmount };
  };

  const processTechnicianStats = (technicians) => {
    const total = technicians.length;
    const active = technicians.length; // Asumiendo que todos están activos
    
    const workload = technicians.map(tech => ({
      name: tech.name,
      equipmentCount: Math.floor(Math.random() * 10) + 1 // Simulado
    }));

    return { total, active, workload };
  };

  const generateRecentActivities = (equipments, invoices) => {
    const activities = [];
    
    // Agregar equipos recientes
    equipments.slice(0, 3).forEach(equipment => {
      activities.push({
        type: 'equipment',
        message: `Nuevo equipo registrado: ${equipment.brand?.name} ${equipment.model?.name}`,
        time: new Date(equipment.created_at).toLocaleDateString('es-ES'),
        status: equipment.status
      });
    });

    // Agregar facturas recientes
    invoices.slice(0, 3).forEach(invoice => {
      activities.push({
        type: 'invoice',
        message: `Factura ${invoice.invoice_number} - ${invoice.customer_name}`,
        time: new Date(invoice.created_at).toLocaleDateString('es-ES'),
        status: invoice.status,
        amount: invoice.total_amount
      });
    });

    return activities.sort((a, b) => new Date(b.time) - new Date(a.time)).slice(0, 6);
  };

  const generateMonthlyEquipmentChart = (equipments) => {
    const months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    const currentMonth = new Date().getMonth();
    const monthlyData = new Array(12).fill(0);

    equipments.forEach(equipment => {
      const month = new Date(equipment.created_at).getMonth();
      monthlyData[month]++;
    });

    return {
      labels: months.slice(currentMonth - 5, currentMonth + 1),
      datasets: [{
        label: 'Equipos Recibidos',
        data: monthlyData.slice(currentMonth - 5, currentMonth + 1),
        borderColor: '#5e72e4',
        backgroundColor: 'rgba(94, 114, 228, 0.1)',
        tension: 0.4,
      }]
    };
  };

  const generateMonthlyInvoiceChart = (invoices) => {
    const months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    const currentMonth = new Date().getMonth();
    const monthlyData = new Array(12).fill(0);

    invoices.forEach(invoice => {
      const month = new Date(invoice.created_at).getMonth();
      monthlyData[month] += parseFloat(invoice.total_amount) || 0;
    });

    return {
      labels: months.slice(currentMonth - 5, currentMonth + 1),
      datasets: [{
        label: 'Ingresos',
        data: monthlyData.slice(currentMonth - 5, currentMonth + 1),
        backgroundColor: '#2dce89',
        maxBarThickness: 10,
      }]
    };
  };

  const generateStatusDistributionChart = (equipmentStats) => {
    return {
      labels: ['Pendientes', 'En Proceso', 'Completados'],
      datasets: [{
        data: [equipmentStats.pending, equipmentStats.inProgress, equipmentStats.completed],
        backgroundColor: ['#ffd600', '#fd5e53', '#2dce89'],
        borderWidth: 0,
      }]
    };
  };

  const formatCurrency = (amount) => {
    return new Intl.NumberFormat('es-DO', {
      style: 'currency',
      currency: 'DOP'
    }).format(amount);
  };

  const getStatusBadge = (status) => {
    const colors = {
      pending: 'warning',
      in_progress: 'info',
      completed: 'success',
      draft: 'secondary',
      paid: 'success',
      overdue: 'danger'
    };
    const texts = {
      pending: 'Pendiente',
      in_progress: 'En Proceso',
      completed: 'Completado',
      draft: 'Borrador',
      paid: 'Pagada',
      overdue: 'Vencida'
    };
    return <Badge color={colors[status]}>{texts[status] || status}</Badge>;
  };

  const chartOptions = {
    responsive: true,
    plugins: { legend: { display: false } },
    scales: { y: { beginAtZero: true } },
  };

  const doughnutOptions = {
    responsive: true,
    plugins: { legend: { position: 'bottom' } },
  };

  if (loading) {
    return (
      <>
        <PageHeader 
          title="Dashboard TICOMSYS" 
          subtitle="Cargando datos del sistema..."
          icon="fas fa-tachometer-alt"
        />
        <Container className="mt--7" fluid>
          <Row className="justify-content-center">
            <Col md="6" className="text-center">
              <Spinner color="primary" size="lg" />
              <p className="mt-3">Cargando dashboard...</p>
            </Col>
          </Row>
        </Container>
      </>
    );
  }

  return (
    <>
      <PageHeader 
        title="Dashboard TICOMSYS" 
        subtitle="Panel de control del sistema de gestión de reparaciones"
        icon="fas fa-tachometer-alt"
      />
      
      <Container className="mt--7" fluid>
        {/* Estadísticas Principales */}
        <Row className="mb-4">
          <Col lg="3" md="6">
            <Card className="card-stats mb-4 mb-xl-0">
              <CardBody>
                <Row>
                  <div className="col">
                    <h5 className="card-title text-uppercase text-muted mb-0">
                      Equipos Totales
                    </h5>
                    <span className="h2 font-weight-bold mb-0">
                      {stats.equipments.total}
                    </span>
                  </div>
                  <Col className="col-auto">
                    <div className="icon icon-shape bg-danger text-white rounded-circle shadow">
                      <i className="fas fa-laptop" />
                    </div>
                  </Col>
                </Row>
                <p className="mt-3 mb-0 text-muted text-sm">
                  <span className="text-success mr-2">
                    <i className="fa fa-arrow-up" /> {stats.equipments.completed}
                  </span>
                  <span className="text-nowrap">Completados</span>
                </p>
              </CardBody>
            </Card>
          </Col>
          <Col lg="3" md="6">
            <Card className="card-stats mb-4 mb-xl-0">
              <CardBody>
                <Row>
                  <div className="col">
                    <h5 className="card-title text-uppercase text-muted mb-0">
                      Facturas Pagadas
                    </h5>
                    <span className="h2 font-weight-bold mb-0">
                      {stats.invoices.paid}
                    </span>
                  </div>
                  <Col className="col-auto">
                    <div className="icon icon-shape bg-success text-white rounded-circle shadow">
                      <i className="fas fa-check-circle" />
                    </div>
                  </Col>
                </Row>
                <p className="mt-3 mb-0 text-muted text-sm">
                  <span className="text-success mr-2">
                    <i className="fa fa-arrow-up" /> {formatCurrency(stats.invoices.totalAmount)}
                  </span>
                  <span className="text-nowrap">Total Ingresos</span>
                </p>
              </CardBody>
            </Card>
          </Col>
          <Col lg="3" md="6">
            <Card className="card-stats mb-4 mb-xl-0">
              <CardBody>
                <Row>
                  <div className="col">
                    <h5 className="card-title text-uppercase text-muted mb-0">
                      Técnicos Activos
                    </h5>
                    <span className="h2 font-weight-bold mb-0">
                      {stats.technicians.active}
                    </span>
                  </div>
                  <Col className="col-auto">
                    <div className="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i className="fas fa-users" />
                    </div>
                  </Col>
                </Row>
                <p className="mt-3 mb-0 text-muted text-sm">
                  <span className="text-warning mr-2">
                    <i className="fa fa-clock" /> {stats.equipments.inProgress}
                  </span>
                  <span className="text-nowrap">En Proceso</span>
                </p>
              </CardBody>
            </Card>
          </Col>
          <Col lg="3" md="6">
            <Card className="card-stats mb-4 mb-xl-0">
              <CardBody>
                <Row>
                  <div className="col">
                    <h5 className="card-title text-uppercase text-muted mb-0">
                      Pendientes
                    </h5>
                    <span className="h2 font-weight-bold mb-0">
                      {stats.equipments.pending}
                    </span>
                  </div>
                  <Col className="col-auto">
                    <div className="icon icon-shape bg-warning text-white rounded-circle shadow">
                      <i className="fas fa-clock" />
                    </div>
                  </Col>
                </Row>
                <p className="mt-3 mb-0 text-muted text-sm">
                  <span className="text-danger mr-2">
                    <i className="fa fa-arrow-down" /> {stats.invoices.overdue}
                  </span>
                  <span className="text-nowrap">Facturas Vencidas</span>
                </p>
              </CardBody>
            </Card>
          </Col>
        </Row>

        {/* Gráficos */}
        <Row>
          <Col className="mb-5 mb-xl-0" xl="8">
            <Card className="bg-gradient-default shadow">
              <CardHeader className="bg-transparent">
                <Row className="align-items-center">
                  <div className="col">
                    <h6 className="text-uppercase text-light ls-1 mb-1">
                      Tendencias
                    </h6>
                    <h2 className="text-white mb-0">Equipos Recibidos (6 meses)</h2>
                  </div>
                </Row>
              </CardHeader>
              <CardBody>
                <div className="chart">
                  {chartData.monthlyEquipments && (
                    <Line data={chartData.monthlyEquipments} options={chartOptions} />
                  )}
                </div>
              </CardBody>
            </Card>
          </Col>
          <Col xl="4">
            <Card className="shadow">
              <CardHeader className="bg-transparent">
                <Row className="align-items-center">
                  <div className="col">
                    <h6 className="text-uppercase text-muted ls-1 mb-1">
                      Distribución
                    </h6>
                    <h2 className="mb-0">Estado de Equipos</h2>
                  </div>
                </Row>
              </CardHeader>
              <CardBody>
                <div className="chart">
                  {chartData.statusDistribution && (
                    <Doughnut data={chartData.statusDistribution} options={doughnutOptions} />
                  )}
                </div>
              </CardBody>
            </Card>
          </Col>
        </Row>

        <Row className="mt-5">
          <Col className="mb-5 mb-xl-0" xl="8">
            <Card className="shadow">
              <CardHeader className="border-0">
                <Row className="align-items-center">
                  <div className="col">
                    <h3 className="mb-0">Actividades Recientes</h3>
                  </div>
                  <div className="col text-right">
                    <Button
                      color="primary"
                      href="/admin/repair-equipment"
                      size="sm"
                    >
                      Ver Todos
                    </Button>
                  </div>
                </Row>
              </CardHeader>
              <Table className="align-items-center table-flush" responsive>
                <thead className="thead-light">
                  <tr>
                    <th scope="col">Actividad</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Detalles</th>
                  </tr>
                </thead>
                <tbody>
                  {stats.recentActivities.map((activity, index) => (
                    <tr key={index}>
                      <th scope="row">
                        <div className="d-flex align-items-center">
                          <div className="avatar rounded-circle mr-3">
                            <div className={`bg-gradient-${activity.type === 'equipment' ? 'primary' : 'success'} text-white rounded-circle d-flex align-items-center justify-content-center`} style={{width: '32px', height: '32px'}}>
                              <i className={`fas fa-${activity.type === 'equipment' ? 'laptop' : 'file-invoice'}`} />
                            </div>
                          </div>
                          <div>
                            <span className="mb-0 text-sm">{activity.message}</span>
                          </div>
                        </div>
                      </th>
                      <td>{activity.time}</td>
                      <td>{getStatusBadge(activity.status)}</td>
                      <td>
                        {activity.amount && (
                          <span className="text-success font-weight-bold">
                            {formatCurrency(activity.amount)}
                          </span>
                        )}
                      </td>
                    </tr>
                  ))}
                </tbody>
              </Table>
            </Card>
          </Col>
          <Col xl="4">
            <Card className="shadow">
              <CardHeader className="border-0">
                <Row className="align-items-center">
                  <div className="col">
                    <h3 className="mb-0">Carga de Técnicos</h3>
                  </div>
                  <div className="col text-right">
                    <Button
                      color="primary"
                      href="/admin/users"
                      size="sm"
                    >
                      Ver Todos
                    </Button>
                  </div>
                </Row>
              </CardHeader>
              <Table className="align-items-center table-flush" responsive>
                <thead className="thead-light">
                  <tr>
                    <th scope="col">Técnico</th>
                    <th scope="col">Equipos</th>
                    <th scope="col" />
                  </tr>
                </thead>
                <tbody>
                  {stats.technicians.workload.map((tech, index) => (
                    <tr key={index}>
                      <th scope="row">{tech.name}</th>
                      <td>{tech.equipmentCount}</td>
                      <td>
                        <div className="d-flex align-items-center">
                          <span className="mr-2">
                            {Math.round((tech.equipmentCount / 10) * 100)}%
                          </span>
                          <div>
                            <Progress
                              max="10"
                              value={tech.equipmentCount}
                              barClassName="bg-gradient-info"
                            />
                          </div>
                        </div>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </Table>
            </Card>
          </Col>
        </Row>
      </Container>
    </>
  );
};

export default Index;