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
  CardFooter,
  DropdownMenu,
  DropdownItem,
  UncontrolledDropdown,
  DropdownToggle,
  Media,
  Pagination,
  PaginationItem,
  PaginationLink,
  Progress,
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
} from "reactstrap";
// core components
import { useState, useEffect } from "react";

const TicketManagement = () => {
  const [tickets, setTickets] = useState([]);
  const [loading, setLoading] = useState(true);
  const [modal, setModal] = useState(false);
  const [statusModal, setStatusModal] = useState(false);
  const [selectedTicket, setSelectedTicket] = useState(null);
  const [formData, setFormData] = useState({
    status: '',
    resolution_notes: ''
  });
  const [alert, setAlert] = useState({ show: false, message: '', color: 'success' });

  useEffect(() => {
    loadTickets();
  }, []);

  const loadTickets = async () => {
    try {
      const response = await fetch('/api/tickets', {
        credentials: 'include',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
        }
      });
      if (response.ok) {
        const data = await response.json();
        setTickets(data.data || data);
      } else {
        console.error('Error loading tickets:', response.status, response.statusText);
        showAlert('Error al cargar los tickets', 'danger');
      }
    } catch (error) {
      console.error('Error loading tickets:', error);
      showAlert('Error al cargar los tickets', 'danger');
    }
    setLoading(false);
  };

  const showAlert = (message, color = 'success') => {
    setAlert({ show: true, message, color });
    setTimeout(() => setAlert({ show: false, message: '', color: 'success' }), 5000);
  };

  const openStatusModal = (ticket) => {
    setSelectedTicket(ticket);
    setFormData({
      status: ticket.status,
      resolution_notes: ticket.resolution_notes || ''
    });
    setStatusModal(true);
  };

  const handleStatusUpdate = async (e) => {
    e.preventDefault();
    
    try {
      const response = await fetch(`/api/tickets/${selectedTicket.id}/update-status`, {
        method: 'POST',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify(formData)
      });

      if (response.ok) {
        showAlert('Estado del ticket actualizado exitosamente');
        setStatusModal(false);
        loadTickets();
      } else {
        const error = await response.json();
        showAlert(error.message || 'Error al actualizar el estado', 'danger');
      }
    } catch (error) {
      console.error('Error updating ticket status:', error);
      showAlert('Error al actualizar el estado del ticket', 'danger');
    }
  };

  const getPriorityBadgeColor = (priority) => {
    switch (priority) {
      case 'urgent': return 'danger';
      case 'high': return 'warning';
      case 'medium': return 'primary';
      case 'low': return 'secondary';
      default: return 'secondary';
    }
  };

  const getStatusBadgeColor = (status) => {
    switch (status) {
      case 'open': return 'primary';
      case 'in_progress': return 'info';
      case 'waiting_customer': return 'warning';
      case 'waiting_parts': return 'secondary';
      case 'resolved': return 'success';
      case 'closed': return 'dark';
      case 'cancelled': return 'danger';
      default: return 'secondary';
    }
  };

  const getPriorityText = (priority) => {
    switch (priority) {
      case 'urgent': return 'Urgente';
      case 'high': return 'Alta';
      case 'medium': return 'Media';
      case 'low': return 'Baja';
      default: return 'Desconocida';
    }
  };

  const getStatusText = (status) => {
    switch (status) {
      case 'open': return 'Abierto';
      case 'in_progress': return 'En Progreso';
      case 'waiting_customer': return 'Esperando Cliente';
      case 'waiting_parts': return 'Esperando Repuestos';
      case 'resolved': return 'Resuelto';
      case 'closed': return 'Cerrado';
      case 'cancelled': return 'Cancelado';
      default: return 'Desconocido';
    }
  };

  if (loading) {
    return (
      <Container className="mt--7" fluid>
        <Row>
          <Col>
            <Alert color="info">Cargando tickets...</Alert>
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
                <h1 className="display-2 text-white">Estados de Tickets</h1>
                <p className="text-white mt-0 mb-5">
                  Gestiona el estado de los tickets creados automáticamente al recibir equipos
                </p>
              </div>
            </Row>
          </div>
        </Container>
      </div>
      
      {/* Page content */}
      <Container className="mt--7" fluid>
        {alert.show && (
          <Alert color={alert.color} className="mb-4">
            {alert.message}
          </Alert>
        )}

        {/* Tickets Table */}
        <Row>
          <div className="col">
            <Card className="shadow">
              <CardHeader className="border-0">
                <Row className="align-items-center">
                  <Col>
                    <h3 className="mb-0">Estados de Tickets de Equipos</h3>
                  </Col>
                  <Col className="text-right">
                    <Button color="primary" size="sm" onClick={loadTickets}>
                      <i className="ni ni-settings-gear-65 mr-1" />
                      Actualizar Lista
                    </Button>
                  </Col>
                </Row>
              </CardHeader>
              <Table className="align-items-center table-flush" responsive>
                <thead className="thead-light">
                  <tr>
                    <th scope="col">Ticket</th>
                    <th scope="col">Equipo</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Técnico</th>
                    <th scope="col">Fecha Límite</th>
                    <th scope="col">Acciones</th>
                    <th scope="col" />
                  </tr>
                </thead>
                <tbody>
                  {tickets.map((ticket) => (
                    <tr key={ticket.id}>
                      <th scope="row">
                        <Media className="align-items-center">
                          <div className="avatar bg-info rounded-circle mr-3">
                            <i className="ni ni-single-copy-04 text-white" />
                          </div>
                          <Media>
                            <span className="mb-0 text-sm font-weight-bold">
                              {ticket.ticket_number}
                            </span>
                            <br />
                            <span className="text-muted text-sm">
                              {ticket.title}
                            </span>
                          </Media>
                        </Media>
                      </th>
                      <td>
                        <span className="text-sm">
                          {ticket.repair_equipment?.brand} {ticket.repair_equipment?.model}
                        </span>
                      </td>
                      <td>
                        <span className="text-sm">
                          {ticket.repair_equipment?.customer_name}
                        </span>
                      </td>
                      <td>
                        <Badge color={getPriorityBadgeColor(ticket.priority)}>
                          {getPriorityText(ticket.priority)}
                        </Badge>
                      </td>
                      <td>
                        <Badge color={getStatusBadgeColor(ticket.status)}>
                          {getStatusText(ticket.status)}
                        </Badge>
                      </td>
                      <td>
                        <span className="text-sm">
                          {ticket.assigned_technician?.name || 'Sin asignar'}
                        </span>
                      </td>
                      <td>
                        <span className="text-sm">
                          {ticket.due_date ? new Date(ticket.due_date).toLocaleDateString() : 'No definida'}
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
                                openStatusModal(ticket);
                              }}
                            >
                              <i className="ni ni-settings-gear-65 mr-2" />
                              Actualizar Estado
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
                              <i className="ni ni-single-copy-04 mr-2" />
                              Ver Equipo
                            </DropdownItem>
                          </DropdownMenu>
                        </UncontrolledDropdown>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </Table>
              {tickets.length === 0 && (
                <div className="text-center py-4">
                  <p className="text-muted">No hay tickets disponibles</p>
                </div>
              )}
            </Card>
          </div>
        </Row>

        {/* Modal para actualizar estado */}
        <Modal isOpen={statusModal} toggle={() => setStatusModal(false)} size="lg">
          <ModalHeader toggle={() => setStatusModal(false)}>
            Actualizar Estado - {selectedTicket?.ticket_number}
          </ModalHeader>
          <ModalBody>
            <Form onSubmit={handleStatusUpdate}>
              <FormGroup>
                <Label>Estado del Ticket</Label>
                <Input
                  type="select"
                  value={formData.status}
                  onChange={(e) => setFormData({...formData, status: e.target.value})}
                  required
                >
                  <option value="open">Abierto</option>
                  <option value="in_progress">En Progreso</option>
                  <option value="waiting_customer">Esperando Cliente</option>
                  <option value="waiting_parts">Esperando Repuestos</option>
                  <option value="resolved">Resuelto</option>
                  <option value="closed">Cerrado</option>
                  <option value="cancelled">Cancelado</option>
                </Input>
              </FormGroup>
              <FormGroup>
                <Label>Notas de Resolución</Label>
                <Input
                  type="textarea"
                  rows="4"
                  value={formData.resolution_notes}
                  onChange={(e) => setFormData({...formData, resolution_notes: e.target.value})}
                  placeholder="Agregar notas sobre la resolución del ticket..."
                />
              </FormGroup>
              <Button color="primary" type="submit">
                Actualizar Estado
              </Button>
              <Button color="secondary" onClick={() => setStatusModal(false)} className="ml-2">
                Cancelar
              </Button>
            </Form>
          </ModalBody>
        </Modal>
      </Container>
    </>
  );
};

export default TicketManagement;