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
import PageHeader from "components/Headers/PageHeader.js";

const RepairEquipmentManagement = () => {
  const [equipments, setEquipments] = useState([]);
  const [technicians, setTechnicians] = useState([]);
  const [brands, setBrands] = useState([]);
  const [types, setTypes] = useState([]);
  const [models, setModels] = useState([]);
  const [loading, setLoading] = useState(true);
  const [modal, setModal] = useState(false);
  const [statusModal, setStatusModal] = useState(false);
  const [selectedEquipment, setSelectedEquipment] = useState(null);
  const [formData, setFormData] = useState({
    customer_name: '',
    customer_phone: '',
    customer_email: '',
    brand_id: '',
    type_id: '',
    model_id: '',
    serial_number: '',
    problem_description: '',
    accessories: '',
    notes: '',
    estimated_cost: '',
    estimated_delivery: '',
    assigned_technician_id: '',
    status: 'received'
  });
  const [statusFormData, setStatusFormData] = useState({
    status: '',
    description: '',
    notes: ''
  });
  const [alert, setAlert] = useState({ show: false, message: '', color: 'success' });

  useEffect(() => {
    console.log('🚀 Iniciando carga de datos...');
    // Cargar técnicos primero para debuggear
    loadTechnicians();
    loadEquipments();
    loadBrands();
    loadTypes();
    loadModels();
  }, []);

  const loadEquipments = async () => {
    try {
      console.log('🔧 Cargando equipos...');
      // Usar endpoint autenticado para obtener datos completos incluyendo facturas
      const response = await fetch('/api/repair-equipment', {
        credentials: 'include',
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        }
      });
      
      console.log('🔧 Response status:', response.status);
      
      if (response.ok) {
        const data = await response.json();
        console.log('🔧 Equipos recibidos:', data);
        setEquipments(data.data || data);
        console.log('🔧 Equipos establecidos en estado');
      } else {
        console.error('🔧 Error en response:', response.status, response.statusText);
        showAlert('Error al cargar los equipos', 'danger');
      }
    } catch (error) {
      console.error('🔧 Error loading equipments:', error);
      showAlert('Error al cargar los equipos', 'danger');
    }
    setLoading(false);
  };

  const loadTechnicians = async () => {
    try {
      const response = await fetch('/api/public/repair-equipment/create', {
        headers: {
          'Accept': 'application/json',
        }
      });
      
      if (response.ok) {
        const data = await response.json();
        setTechnicians(data.technicians || []);
      } else {
        showAlert('Error al cargar los técnicos', 'danger');
      }
    } catch (error) {
      showAlert('Error al cargar los técnicos', 'danger');
    }
  };

  const loadBrands = async () => {
    try {
      const response = await fetch('/api/public/brands', {
        headers: {
          'Accept': 'application/json',
        }
      });
      
      if (response.ok) {
        const data = await response.json();
        setBrands(data.brands || []);
      }
    } catch (error) {
      showAlert('Error al cargar las marcas', 'danger');
    }
  };

  const loadTypes = async () => {
    try {
      const response = await fetch('/api/public/types', {
        headers: {
          'Accept': 'application/json',
        }
      });
      
      if (response.ok) {
        const data = await response.json();
        setTypes(data.types || []);
      }
    } catch (error) {
      showAlert('Error al cargar los tipos', 'danger');
    }
  };

  const loadModels = async () => {
    try {
      const response = await fetch('/api/public/models', {
        headers: {
          'Accept': 'application/json',
        }
      });
      
      if (response.ok) {
        const data = await response.json();
        setModels(data.models || []);
      }
    } catch (error) {
      showAlert('Error al cargar los modelos', 'danger');
    }
  };

  const showAlert = (message, color = 'success') => {
    setAlert({ show: true, message, color });
    setTimeout(() => setAlert({ show: false, message: '', color: 'success' }), 5000);
  };

  const openModal = async (equipment = null) => {
    // Asegurar que los técnicos estén cargados
    if (technicians.length === 0) {
      await loadTechnicians();
    }
    
    if (equipment) {
      setFormData({
        customer_name: equipment.customer_name || '',
        customer_phone: equipment.customer_phone || '',
        customer_email: equipment.customer_email || '',
        brand_id: equipment.brand_id || '',
        type_id: equipment.type_id || '',
        model_id: equipment.model_id || '',
        serial_number: equipment.serial_number || '',
        problem_description: equipment.problem_description || '',
        accessories: equipment.accessories || '',
        notes: equipment.notes || '',
        estimated_cost: equipment.estimated_cost || '',
        estimated_delivery: equipment.estimated_delivery ? equipment.estimated_delivery.split('T')[0] : '',
        assigned_technician_id: equipment.assigned_technician_id || '',
        status: equipment.status || 'received'
      });
      setSelectedEquipment(equipment);
    } else {
      setFormData({
        customer_name: '',
        customer_phone: '',
        customer_email: '',
        brand_id: '',
        type_id: '',
        model_id: '',
        serial_number: '',
        problem_description: '',
        accessories: '',
        notes: '',
        estimated_cost: '',
        estimated_delivery: '',
        assigned_technician_id: '',
        status: 'received'
      });
      setSelectedEquipment(null);
    }
    setModal(true);
  };

  const openStatusModal = (equipment) => {
    setSelectedEquipment(equipment);
    setStatusFormData({
      status: equipment.status,
      description: '',
      notes: ''
    });
    setStatusModal(true);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    try {
      const url = selectedEquipment 
        ? `/api/repair-equipment/${selectedEquipment.id}`
        : '/api/repair-equipment';
      
      const method = selectedEquipment ? 'PUT' : 'POST';
      
      console.log('🔧 Enviando formulario:', {
        url,
        method,
        formData,
        selectedEquipment: selectedEquipment?.id
      });
      
      const response = await fetch(url, {
        method,
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify(formData)
      });

      console.log('🔧 Response status:', response.status);

      if (response.ok) {
        const result = await response.json();
        console.log('🔧 Success result:', result);
        showAlert(selectedEquipment ? 'Equipo actualizado exitosamente' : 'Equipo registrado exitosamente');
        setModal(false);
        loadEquipments();
      } else {
        const error = await response.json();
        console.error('🔧 Error response:', error);
        
        // Mostrar errores de validación específicos
        if (error.errors) {
          const errorMessages = [];
          for (const field in error.errors) {
            errorMessages.push(`${field}: ${error.errors[field].join(', ')}`);
          }
          showAlert(`Errores de validación:\n${errorMessages.join('\n')}`, 'danger');
        } else {
          showAlert(error.message || 'Error al procesar la solicitud', 'danger');
        }
      }
    } catch (error) {
      console.error('Error saving equipment:', error);
      showAlert('Error al guardar el equipo', 'danger');
    }
  };

  const handleStatusUpdate = async (e) => {
    e.preventDefault();
    
    try {
      const response = await fetch(`/api/repair-equipment/${selectedEquipment.id}/update-status`, {
        method: 'POST',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify(statusFormData)
      });

      if (response.ok) {
        showAlert('Estado del equipo actualizado exitosamente');
        setStatusModal(false);
        loadEquipments();
      } else {
        const error = await response.json();
        showAlert(error.message || 'Error al actualizar el estado', 'danger');
      }
    } catch (error) {
      console.error('Error updating equipment status:', error);
      showAlert('Error al actualizar el estado del equipo', 'danger');
    }
  };

  const handleDelete = async (equipment) => {
    if (window.confirm('¿Estás seguro de que deseas eliminar este equipo?')) {
      try {
        const response = await fetch(`/api/repair-equipment/${equipment.id}`, {
          method: 'DELETE',
          credentials: 'include',
          headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
          }
        });

        if (response.ok) {
          showAlert('Equipo eliminado exitosamente');
          loadEquipments();
        } else {
          showAlert('Error al eliminar el equipo', 'danger');
        }
      } catch (error) {
        console.error('Error deleting equipment:', error);
        showAlert('Error al eliminar el equipo', 'danger');
      }
    }
  };

  const getStatusBadgeColor = (status) => {
    switch (status) {
      case 'received': return 'primary';
      case 'in_review': return 'info';
      case 'in_repair': return 'warning';
      case 'waiting_parts': return 'secondary';
      case 'ready': return 'success';
      case 'delivered': return 'dark';
      case 'cancelled': return 'danger';
      default: return 'secondary';
    }
  };

  const getStatusText = (status) => {
    switch (status) {
      case 'received': return 'Recibido';
      case 'in_review': return 'En Revisión';
      case 'in_repair': return 'En Reparación';
      case 'waiting_parts': return 'Esperando Repuestos';
      case 'ready': return 'Listo';
      case 'delivered': return 'Entregado';
      case 'cancelled': return 'Cancelado';
      default: return 'Desconocido';
    }
  };

  const getInvoiceStatusColor = (status) => {
    const statusMap = {
      'draft': 'secondary',
      'sent': 'info',
      'paid': 'success',
      'overdue': 'warning',
      'cancelled': 'danger'
    };
    return statusMap[status] || 'secondary';
  };

  const getInvoiceStatusText = (status) => {
    const statusMap = {
      'draft': 'Borrador',
      'sent': 'Enviada',
      'paid': 'Pagada',
      'overdue': 'Vencida',
      'cancelled': 'Cancelada'
    };
    return statusMap[status] || status;
  };

  const createInvoiceFromEquipment = async (equipment) => {
    try {
      const response = await fetch(`/api/invoices/create-from-equipment/${equipment.id}`, {
        method: 'POST',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        }
      });

      if (response.ok) {
        const result = await response.json();
        showAlert('Factura creada exitosamente');
        loadEquipments(); // Recargar para mostrar la nueva factura
        // Opcional: abrir la factura en una nueva pestaña
        window.open(`/admin/invoices/${result.invoice.id}`, '_blank');
      } else {
        const error = await response.json();
        showAlert(error.message || 'Error al crear la factura', 'danger');
      }
    } catch (error) {
      console.error('Error creating invoice:', error);
      showAlert('Error al crear la factura', 'danger');
    }
  };

  if (loading) {
    return (
      <Container className="mt--7" fluid>
        <Row>
          <Col>
            <Alert color="info">Cargando equipos...</Alert>
          </Col>
        </Row>
      </Container>
    );
  }

  return (
    <>
      <PageHeader 
        title="Equipos de Reparación" 
        subtitle="Gestiona los equipos recibidos para reparación"
        icon="fas fa-laptop"
      />
      
      {/* Page content */}
      <Container className="mt--7" fluid>
        {alert.show && (
          <Alert color={alert.color} className="mb-4">
            {alert.message}
          </Alert>
        )}

        {/* Equipment Table */}
        <Row>
          <div className="col">
            <Card className="shadow">
              <CardHeader className="border-0">
                <Row className="align-items-center">
                  <Col>
                    <h3 className="mb-0">Equipos de Reparación</h3>
                  </Col>
                  <Col className="text-right">
                    <Button color="primary" size="sm" onClick={() => openModal()}>
                      <i className="ni ni-fat-add mr-1" />
                      Nuevo Equipo
                    </Button>
                  </Col>
                </Row>
              </CardHeader>
              <Table className="align-items-center table-flush" responsive>
                <thead className="thead-light">
                  <tr>
                    <th scope="col">Ticket</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Equipo</th>
                    <th scope="col">Problema</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Técnico</th>
                    <th scope="col">Costo</th>
                    <th scope="col">Factura</th>
                    <th scope="col">Acciones</th>
                    <th scope="col" />
                  </tr>
                </thead>
                <tbody>
                  {equipments.map((equipment) => (
                    <tr key={equipment.id}>
                      <th scope="row">
                        <Media className="align-items-center">
                          <div className="avatar bg-info rounded-circle mr-3">
                            <i className="ni ni-settings-gear-65 text-white" />
                          </div>
                          <Media>
                            <span className="mb-0 text-sm font-weight-bold">
                              {equipment.ticket_number}
                            </span>
                            <br />
                            <span className="text-muted text-sm">
                              {equipment.serial_number || 'Sin serie'}
                            </span>
                          </Media>
                        </Media>
                      </th>
                      <td>
                        <span className="text-sm font-weight-bold">
                          {equipment.customer_name}
                        </span>
                        <br />
                        <span className="text-muted text-sm">
                          {equipment.customer_phone}
                        </span>
                      </td>
                      <td>
                        <span className="text-sm">
                          {equipment.brand?.name} {equipment.model?.name}
                        </span>
                        <br />
                        <span className="text-muted text-sm">
                          {equipment.type?.name}
                        </span>
                      </td>
                      <td>
                        <span className="text-sm">
                          {equipment.problem_description?.substring(0, 50)}...
                        </span>
                      </td>
                      <td>
                        <Badge color={getStatusBadgeColor(equipment.status)}>
                          {getStatusText(equipment.status)}
                        </Badge>
                      </td>
                      <td>
                        <span className="text-sm">
                          {equipment.assigned_technician?.name || 'Sin asignar'}
                        </span>
                      </td>
                      <td>
                        <span className="text-sm">
                          ${equipment.estimated_cost ? parseFloat(equipment.estimated_cost).toFixed(2) : '0.00'}
                        </span>
                      </td>
                      <td>
                        {equipment.invoices && equipment.invoices.length > 0 ? (
                          <div>
                            <Badge color={getInvoiceStatusColor(equipment.invoices[0].status)} className="mb-1">
                              {getInvoiceStatusText(equipment.invoices[0].status)}
                            </Badge>
                            <br />
                            <small className="text-muted">
                              ${equipment.invoices[0].total_amount ? parseFloat(equipment.invoices[0].total_amount).toFixed(2) : '0.00'}
                            </small>
                          </div>
                        ) : (
                          <Badge color="secondary">Sin factura</Badge>
                        )}
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
                                openStatusModal(equipment);
                              }}
                            >
                              <i className="ni ni-settings-gear-65 mr-2" />
                              Actualizar Estado
                            </DropdownItem>
                            <DropdownItem
                              href="#pablo"
                              onClick={(e) => {
                                e.preventDefault();
                                openModal(equipment);
                              }}
                            >
                              <i className="ni ni-settings mr-2" />
                              Editar
                            </DropdownItem>
                            {equipment.invoices && equipment.invoices.length > 0 ? (
                              <DropdownItem
                                href="#pablo"
                                onClick={(e) => {
                                  e.preventDefault();
                                  window.open(`/admin/invoice-view?id=${equipment.invoices[0].id}`, '_blank');
                                }}
                              >
                                <i className="ni ni-single-copy-04 mr-2" />
                                Ver Factura
                              </DropdownItem>
                            ) : (
                              <DropdownItem
                                href="#pablo"
                                onClick={(e) => {
                                  e.preventDefault();
                                  createInvoiceFromEquipment(equipment);
                                }}
                              >
                                <i className="ni ni-fat-add mr-2" />
                                Crear Factura
                              </DropdownItem>
                            )}
                            <DropdownItem divider />
                            <DropdownItem
                              href="#pablo"
                              onClick={(e) => {
                                e.preventDefault();
                                handleDelete(equipment);
                              }}
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
              {equipments.length === 0 && (
                <div className="text-center py-4">
                  <p className="text-muted">No hay equipos registrados</p>
                </div>
              )}
            </Card>
          </div>
        </Row>

        {/* Modal para crear/editar equipo */}
        <Modal isOpen={modal} toggle={() => setModal(false)} size="lg">
          <ModalHeader toggle={() => setModal(false)}>
            {selectedEquipment ? 'Editar Equipo' : 'Nuevo Equipo'}
          </ModalHeader>
          <ModalBody>
            <Form onSubmit={handleSubmit}>
              <Row>
                <Col md="6">
                  <FormGroup>
                    <Label>Nombre del Cliente *</Label>
                    <Input
                      type="text"
                      value={formData.customer_name}
                      onChange={(e) => setFormData({...formData, customer_name: e.target.value})}
                      required
                    />
                  </FormGroup>
                </Col>
                <Col md="6">
                  <FormGroup>
                    <Label>Teléfono *</Label>
                    <Input
                      type="tel"
                      value={formData.customer_phone}
                      onChange={(e) => setFormData({...formData, customer_phone: e.target.value})}
                      required
                    />
                  </FormGroup>
                </Col>
              </Row>
              <Row>
                <Col md="6">
                  <FormGroup>
                    <Label>Email</Label>
                    <Input
                      type="email"
                      value={formData.customer_email}
                      onChange={(e) => setFormData({...formData, customer_email: e.target.value})}
                    />
                  </FormGroup>
                </Col>
                <Col md="6">
                  <FormGroup>
                    <Label>Marca *</Label>
                    <Input
                      type="select"
                      value={formData.brand_id}
                      onChange={(e) => setFormData({...formData, brand_id: e.target.value, model_id: ''})}
                      required
                    >
                      <option value="">Seleccionar marca...</option>
                      {brands.map(brand => (
                        <option key={brand.id} value={brand.id}>{brand.name}</option>
                      ))}
                    </Input>
                  </FormGroup>
                </Col>
              </Row>
              <Row>
                <Col md="6">
                  <FormGroup>
                    <Label>Tipo de Equipo *</Label>
                    <Input
                      type="select"
                      value={formData.type_id}
                      onChange={(e) => setFormData({...formData, type_id: e.target.value, model_id: ''})}
                      required
                    >
                      <option value="">Seleccionar tipo...</option>
                      {types.map(type => (
                        <option key={type.id} value={type.id}>{type.name}</option>
                      ))}
                    </Input>
                  </FormGroup>
                </Col>
                <Col md="6">
                  <FormGroup>
                    <Label>Modelo *</Label>
                    <Input
                      type="select"
                      value={formData.model_id}
                      onChange={(e) => setFormData({...formData, model_id: e.target.value})}
                      disabled={!formData.brand_id || !formData.type_id}
                      required
                    >
                      <option value="">Seleccionar modelo...</option>
                      {models
                        .filter(model => model.brand_id == formData.brand_id && model.type_id == formData.type_id)
                        .map(model => (
                          <option key={model.id} value={model.id}>{model.name}</option>
                        ))}
                    </Input>
                  </FormGroup>
                </Col>
              </Row>
              <Row>
                <Col md="6">
                  <FormGroup>
                    <Label>Número de Serie</Label>
                    <Input
                      type="text"
                      value={formData.serial_number}
                      onChange={(e) => setFormData({...formData, serial_number: e.target.value})}
                    />
                  </FormGroup>
                </Col>
                <Col md="6">
                  <FormGroup>
                    <Label>Técnico Asignado</Label>
                    <Input
                      type="select"
                      value={formData.assigned_technician_id}
                      onChange={(e) => setFormData({...formData, assigned_technician_id: e.target.value})}
                    >
                      <option value="">Seleccionar técnico...</option>
                      {technicians.length > 0 ? (
                        technicians.map(tech => (
                          <option key={tech.id} value={tech.id}>{tech.name}</option>
                        ))
                      ) : (
                        <option disabled>No hay técnicos disponibles</option>
                      )}
                    </Input>
                  </FormGroup>
                </Col>
              </Row>
              <FormGroup>
                <Label>Descripción del Problema *</Label>
                <Input
                  type="textarea"
                  rows="3"
                  value={formData.problem_description}
                  onChange={(e) => setFormData({...formData, problem_description: e.target.value})}
                  required
                />
              </FormGroup>
              <Row>
                <Col md="6">
                  <FormGroup>
                    <Label>Accesorios</Label>
                    <Input
                      type="textarea"
                      rows="2"
                      value={formData.accessories}
                      onChange={(e) => setFormData({...formData, accessories: e.target.value})}
                    />
                  </FormGroup>
                </Col>
                <Col md="6">
                  <FormGroup>
                    <Label>Notas</Label>
                    <Input
                      type="textarea"
                      rows="2"
                      value={formData.notes}
                      onChange={(e) => setFormData({...formData, notes: e.target.value})}
                    />
                  </FormGroup>
                </Col>
              </Row>
              <Row>
                <Col md="6">
                  <FormGroup>
                    <Label>Costo Estimado</Label>
                    <Input
                      type="number"
                      step="0.01"
                      value={formData.estimated_cost}
                      onChange={(e) => setFormData({...formData, estimated_cost: e.target.value})}
                    />
                  </FormGroup>
                </Col>
                <Col md="6">
                  <FormGroup>
                    <Label>Fecha Estimada de Entrega</Label>
                    <Input
                      type="date"
                      value={formData.estimated_delivery}
                      onChange={(e) => setFormData({...formData, estimated_delivery: e.target.value})}
                    />
                  </FormGroup>
                </Col>
              </Row>
              <Button color="primary" type="submit">
                {selectedEquipment ? 'Actualizar' : 'Registrar'}
              </Button>
              <Button color="secondary" onClick={() => setModal(false)} className="ml-2">
                Cancelar
              </Button>
            </Form>
          </ModalBody>
        </Modal>

        {/* Modal para actualizar estado */}
        <Modal isOpen={statusModal} toggle={() => setStatusModal(false)} size="lg">
          <ModalHeader toggle={() => setStatusModal(false)}>
            Actualizar Estado - {selectedEquipment?.ticket_number}
          </ModalHeader>
          <ModalBody>
            <Form onSubmit={handleStatusUpdate}>
              <FormGroup>
                <Label>Estado del Equipo</Label>
                <Input
                  type="select"
                  value={statusFormData.status}
                  onChange={(e) => setStatusFormData({...statusFormData, status: e.target.value})}
                  required
                >
                  <option value="received">Recibido</option>
                  <option value="in_review">En Revisión</option>
                  <option value="in_repair">En Reparación</option>
                  <option value="waiting_parts">Esperando Repuestos</option>
                  <option value="ready">Listo</option>
                  <option value="delivered">Entregado</option>
                  <option value="cancelled">Cancelado</option>
                </Input>
              </FormGroup>
              <FormGroup>
                <Label>Descripción del Estado</Label>
                <Input
                  type="textarea"
                  rows="3"
                  value={statusFormData.description}
                  onChange={(e) => setStatusFormData({...statusFormData, description: e.target.value})}
                  placeholder="Describir el estado actual del equipo..."
                />
              </FormGroup>
              <FormGroup>
                <Label>Notas Adicionales</Label>
                <Input
                  type="textarea"
                  rows="2"
                  value={statusFormData.notes}
                  onChange={(e) => setStatusFormData({...statusFormData, notes: e.target.value})}
                  placeholder="Notas adicionales sobre el estado..."
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

export default RepairEquipmentManagement;