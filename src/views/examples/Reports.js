/*!
=========================================================
* Argon Dashboard React - v1.2.4
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard-react
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard-react/blob/master/LICENSE.md)
* Coded by Creative Tim
=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
*/

// reactstrap components
import {
  Badge,
  Card,
  CardHeader,
  CardBody,
  CardFooter,
  DropdownMenu,
  DropdownItem,
  UncontrolledDropdown,
  DropdownToggle,
  Media,
  Pagination,
  PaginationItem,
  PaginationLink,
  Table,
  Container,
  Row,
  Button,
  Modal,
  ModalHeader,
  ModalBody,
  ModalFooter,
  Form,
  FormGroup,
  Input,
  Label,
  Alert,
  Col,
  Progress,
} from "reactstrap";
// core components
import { useState, useEffect } from "react";

const Reports = () => {
  const [reports, setReports] = useState([]);
  const [loading, setLoading] = useState(true);
  const [modal, setModal] = useState(false);
  const [selectedReport, setSelectedReport] = useState(null);
  const [formData, setFormData] = useState({
    name: '',
    type: '',
    period: 'last_month',
    description: ''
  });

  useEffect(() => {
    loadReports();
  }, []);

  const loadReports = async () => {
    try {
      const response = await fetch('/api/reports');
      if (response.ok) {
        const data = await response.json();
        setReports(data);
      }
    } catch (error) {
      console.error('Error loading reports:', error);
    }
    setLoading(false);
  };

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Aquí se implementaría la creación/edición de reportes
    alert('Reporte guardado correctamente');
    setModal(false);
    setFormData({
      name: '',
      type: '',
      period: 'last_month',
      description: ''
    });
  };

  const openModal = (report = null) => {
    if (report) {
      setSelectedReport(report);
      setFormData({
        name: report.name,
        type: report.type,
        period: report.period,
        description: report.description || ''
      });
    } else {
      setSelectedReport(null);
      setFormData({
        name: '',
        type: '',
        period: 'last_month',
        description: ''
      });
    }
    setModal(true);
  };

  const generateReport = (report) => {
    // Simular generación de reporte
    alert(`Generando reporte: ${report.name}`);
  };

  const getTypeIcon = (type) => {
    const icons = {
      tickets: 'ni ni-single-copy-04',
      equipment: 'ni ni-laptop',
      users: 'ni ni-single-02',
      performance: 'ni ni-chart-bar-32',
      security: 'ni ni-shield-24'
    };
    return icons[type] || 'ni ni-single-copy-04';
  };

  const getTypeBadge = (type) => {
    const typeConfig = {
      tickets: { color: 'primary', text: 'Tickets' },
      equipment: { color: 'info', text: 'Equipos' },
      users: { color: 'success', text: 'Usuarios' },
      performance: { color: 'warning', text: 'Rendimiento' },
      security: { color: 'danger', text: 'Seguridad' }
    };
    
    const config = typeConfig[type] || { color: 'secondary', text: 'Otro' };
    return <Badge color={config.color}>{config.text}</Badge>;
  };

  const getPeriodText = (period) => {
    const periods = {
      today: 'Hoy',
      last_week: 'Última semana',
      last_month: 'Último mes',
      last_quarter: 'Último trimestre',
      last_year: 'Último año',
      realtime: 'Tiempo real'
    };
    return periods[period] || period;
  };

  if (loading) {
    return (
      <Container className="mt--7" fluid>
        <Row>
          <Col>
            <Alert color="info">Cargando reportes...</Alert>
          </Col>
        </Row>
      </Container>
    );
  }

  return (
    <>
      {/* Page Header */}
      <div className="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <Container fluid>
          <div className="header-body">
            <Row>
              <div className="col">
                <h1 className="display-2 text-white">Reportes</h1>
                <p className="text-white mt-0 mb-5">
                  Visualiza estadísticas y reportes del sistema
                </p>
              </div>
            </Row>
          </div>
        </Container>
      </div>
      
      {/* Page content */}
      <Container className="mt--7" fluid>
        {/* Reports Table */}
        <Row>
          <div className="col">
            <Card className="shadow">
              <CardHeader className="border-0">
                <Row className="align-items-center">
                  <Col>
                    <h3 className="mb-0">Reportes del Sistema</h3>
                  </Col>
                  <Col className="text-right">
                    <Button color="primary" size="sm" onClick={() => openModal()}>
                      <i className="ni ni-fat-add mr-1" />
                      Nuevo Reporte
                    </Button>
                  </Col>
                </Row>
              </CardHeader>
              <Table className="align-items-center table-flush" responsive>
                <thead className="thead-light">
                  <tr>
                    <th scope="col">Reporte</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Período</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Última Generación</th>
                    <th scope="col">Acciones</th>
                    <th scope="col" />
                  </tr>
                </thead>
                <tbody>
                  {reports.map((report) => (
                    <tr key={report.id}>
                      <th scope="row">
                        <Media className="align-items-center">
                          <div className="avatar bg-primary rounded-circle mr-3">
                            <i className={`${getTypeIcon(report.type)} text-white`} />
                          </div>
                          <Media>
                            <span className="mb-0 text-sm font-weight-bold">
                              {report.name}
                            </span>
                            <br />
                            <span className="text-muted text-sm">
                              ID: {report.id}
                            </span>
                          </Media>
                        </Media>
                      </th>
                      <td>
                        {getTypeBadge(report.type)}
                      </td>
                      <td>
                        <span className="text-sm">
                          {getPeriodText(report.period)}
                        </span>
                      </td>
                      <td>
                        <Badge color="success">
                          Disponible
                        </Badge>
                      </td>
                      <td>
                        <span className="text-sm">
                          {new Date().toLocaleString()}
                        </span>
                      </td>
                      <td>
                        <UncontrolledDropdown>
                          <DropdownToggle
                            className="btn-icon-only text-light"
                            href="#pablo"
                            role="button"
                            size="sm"
                            color=""
                            onClick={(e) => e.preventDefault()}
                          >
                            <i className="fas fa-ellipsis-v" />
                          </DropdownToggle>
                          <DropdownMenu className="dropdown-menu-arrow" right>
                            <DropdownItem
                              href="#pablo"
                              onClick={(e) => {
                                e.preventDefault();
                                generateReport(report);
                              }}
                            >
                              <i className="ni ni-send mr-2" />
                              Generar
                            </DropdownItem>
                            <DropdownItem
                              href="#pablo"
                              onClick={(e) => {
                                e.preventDefault();
                                openModal(report);
                              }}
                            >
                              <i className="ni ni-settings-gear-65 mr-2" />
                              Editar
                            </DropdownItem>
                            <DropdownItem
                              href="#pablo"
                              onClick={(e) => e.preventDefault()}
                            >
                              <i className="ni ni-zoom-split-in mr-2" />
                              Ver Detalles
                            </DropdownItem>
                            <DropdownItem
                              href="#pablo"
                              onClick={(e) => e.preventDefault()}
                            >
                              <i className="ni ni-fat-remove mr-2" />
                              Eliminar
                            </DropdownItem>
                          </DropdownMenu>
                        </UncontrolledDropdown>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </Table>
              <CardFooter className="py-4">
                <nav aria-label="...">
                  <Pagination
                    className="pagination justify-content-end mb-0"
                    listClassName="justify-content-end mb-0"
                  >
                    <PaginationItem className="disabled">
                      <PaginationLink
                        href="#pablo"
                        onClick={(e) => e.preventDefault()}
                        tabIndex="-1"
                      >
                        <i className="fas fa-angle-left" />
                        <span className="sr-only">Previous</span>
                      </PaginationLink>
                    </PaginationItem>
                    <PaginationItem className="active">
                      <PaginationLink
                        href="#pablo"
                        onClick={(e) => e.preventDefault()}
                      >
                        1
                      </PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                      <PaginationLink
                        href="#pablo"
                        onClick={(e) => e.preventDefault()}
                      >
                        2 <span className="sr-only">(current)</span>
                      </PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                      <PaginationLink
                        href="#pablo"
                        onClick={(e) => e.preventDefault()}
                      >
                        3
                      </PaginationLink>
                    </PaginationItem>
                    <PaginationItem>
                      <PaginationLink
                        href="#pablo"
                        onClick={(e) => e.preventDefault()}
                      >
                        <i className="fas fa-angle-right" />
                        <span className="sr-only">Next</span>
                      </PaginationLink>
                    </PaginationItem>
                  </Pagination>
                </nav>
              </CardFooter>
            </Card>
          </div>
        </Row>

        {/* Quick Stats */}
        <Row className="mt-5">
          <Col lg="3">
            <Card className="card-stats mb-4 mb-xl-0">
              <CardBody>
                <Row>
                  <div className="col">
                    <h5 className="card-title text-uppercase text-muted mb-0">
                      Reportes Disponibles
                    </h5>
                    <span className="h2 font-weight-bold mb-0">
                      {reports.length}
                    </span>
                  </div>
                  <Col className="col-auto">
                    <div className="icon icon-shape bg-primary text-white rounded-circle shadow">
                      <i className="ni ni-single-copy-04" />
                    </div>
                  </Col>
                </Row>
              </CardBody>
            </Card>
          </Col>
          <Col lg="3">
            <Card className="card-stats mb-4 mb-xl-0">
              <CardBody>
                <Row>
                  <div className="col">
                    <h5 className="card-title text-uppercase text-muted mb-0">
                      Generados Hoy
                    </h5>
                    <span className="h2 font-weight-bold mb-0">
                      5
                    </span>
                  </div>
                  <Col className="col-auto">
                    <div className="icon icon-shape bg-success text-white rounded-circle shadow">
                      <i className="ni ni-check-bold" />
                    </div>
                  </Col>
                </Row>
              </CardBody>
            </Card>
          </Col>
          <Col lg="3">
            <Card className="card-stats mb-4 mb-xl-0">
              <CardBody>
                <Row>
                  <div className="col">
                    <h5 className="card-title text-uppercase text-muted mb-0">
                      En Cola
                    </h5>
                    <span className="h2 font-weight-bold mb-0">
                      2
                    </span>
                  </div>
                  <Col className="col-auto">
                    <div className="icon icon-shape bg-warning text-white rounded-circle shadow">
                      <i className="ni ni-settings-gear-65" />
                    </div>
                  </Col>
                </Row>
              </CardBody>
            </Card>
          </Col>
          <Col lg="3">
            <Card className="card-stats mb-4 mb-xl-0">
              <CardBody>
                <Row>
                  <div className="col">
                    <h5 className="card-title text-uppercase text-muted mb-0">
                      Tiempo Promedio
                    </h5>
                    <span className="h2 font-weight-bold mb-0">
                      2.3s
                    </span>
                  </div>
                  <Col className="col-auto">
                    <div className="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i className="ni ni-watch-time" />
                    </div>
                  </Col>
                </Row>
              </CardBody>
            </Card>
          </Col>
        </Row>

        {/* Modal para crear/editar reporte */}
        <Modal isOpen={modal} toggle={() => setModal(false)}>
          <ModalHeader toggle={() => setModal(false)}>
            {selectedReport ? 'Editar Reporte' : 'Nuevo Reporte'}
          </ModalHeader>
          <ModalBody>
            <Form onSubmit={handleSubmit}>
              <FormGroup>
                <Label for="reportName">Nombre del Reporte</Label>
                <Input
                  type="text"
                  name="name"
                  id="reportName"
                  value={formData.name}
                  onChange={handleInputChange}
                  placeholder="Ej: Reporte de Tickets Mensual"
                  required
                />
              </FormGroup>
              <Row>
                <Col md="6">
                  <FormGroup>
                    <Label for="reportType">Tipo de Reporte</Label>
                    <Input
                      type="select"
                      name="type"
                      id="reportType"
                      value={formData.type}
                      onChange={handleInputChange}
                      required
                    >
                      <option value="">Seleccionar tipo...</option>
                      <option value="tickets">Tickets</option>
                      <option value="equipment">Equipos</option>
                      <option value="users">Usuarios</option>
                      <option value="performance">Rendimiento</option>
                      <option value="security">Seguridad</option>
                    </Input>
                  </FormGroup>
                </Col>
                <Col md="6">
                  <FormGroup>
                    <Label for="reportPeriod">Período</Label>
                    <Input
                      type="select"
                      name="period"
                      id="reportPeriod"
                      value={formData.period}
                      onChange={handleInputChange}
                    >
                      <option value="today">Hoy</option>
                      <option value="last_week">Última semana</option>
                      <option value="last_month">Último mes</option>
                      <option value="last_quarter">Último trimestre</option>
                      <option value="last_year">Último año</option>
                      <option value="realtime">Tiempo real</option>
                    </Input>
                  </FormGroup>
                </Col>
              </Row>
              <FormGroup>
                <Label for="reportDescription">Descripción</Label>
                <Input
                  type="textarea"
                  name="description"
                  id="reportDescription"
                  value={formData.description}
                  onChange={handleInputChange}
                  placeholder="Descripción del reporte..."
                  rows="3"
                />
              </FormGroup>
            </Form>
          </ModalBody>
          <ModalFooter>
            <Button color="primary" onClick={handleSubmit}>
              {selectedReport ? 'Actualizar' : 'Crear'} Reporte
            </Button>
            <Button color="secondary" onClick={() => setModal(false)}>
              Cancelar
            </Button>
          </ModalFooter>
        </Modal>
      </Container>
    </>
  );
};

export default Reports;
