/*!
=========================================================
* TicomSys - Sistema de Gestión de Reparaciones
=========================================================
* Módulo de Facturación
=========================================================
*/

import React, { useState, useEffect } from "react";
import { useLocation } from "react-router-dom";
import PageHeader from "components/Headers/PageHeader.js";
// reactstrap components
import {
  Card,
  CardHeader,
  CardBody,
  CardTitle,
  Container,
  Row,
  Col,
  Button,
  Table,
  Badge,
  Modal,
  ModalHeader,
  ModalBody,
  Form,
  FormGroup,
  Label,
  Input,
  Alert,
  UncontrolledAlert
} from "reactstrap";

const InvoiceManagement = () => {
  const location = useLocation();
  const [invoices, setInvoices] = useState([]);
  const [equipments, setEquipments] = useState([]);
  const [tickets, setTickets] = useState([]);
  const [loading, setLoading] = useState(true);
  const [modal, setModal] = useState(false);
  const [selectedInvoice, setSelectedInvoice] = useState(null);
  const [alert, setAlert] = useState({ show: false, message: '', color: 'success' });
  const [formData, setFormData] = useState({
    repair_equipment_id: '',
    ticket_id: '',
    customer_name: '',
    customer_phone: '',
    customer_email: '',
    customer_address: '',
    customer_tax_id: '',
    invoice_date: new Date().toISOString().split('T')[0],
    due_date: '',
    payment_method: '',
    notes: '',
    tax_rate: 16.00,
    discount_amount: 0,
    items: [
      {
        item_type: 'service',
        item_name: '',
        description: '',
        quantity: 1,
        unit: 'pcs',
        unit_price: 0,
        discount_percentage: 0,
        tax_rate: 16.00
      }
    ]
  });

  useEffect(() => {
    loadInvoices();
    loadEquipments();
    loadTickets();
  }, []);

  useEffect(() => {
    // Verificar si hay un parámetro de consulta con el ID de la factura para editar
    const urlParams = new URLSearchParams(location.search);
    const editId = urlParams.get('edit');
    
    if (editId && invoices.length > 0) {
      const invoice = invoices.find(inv => inv.id === parseInt(editId));
      if (invoice) {
        setSelectedInvoice(invoice);
        setFormData({
          repair_equipment_id: invoice.repair_equipment_id || '',
          ticket_id: invoice.ticket_id || '',
          customer_name: invoice.customer_name || '',
          customer_phone: invoice.customer_phone || '',
          customer_email: invoice.customer_email || '',
          customer_address: invoice.customer_address || '',
          customer_tax_id: invoice.customer_tax_id || '',
          invoice_date: invoice.invoice_date,
          due_date: invoice.due_date || '',
          payment_method: invoice.payment_method || '',
          notes: invoice.notes || '',
          tax_rate: invoice.tax_rate,
          discount_amount: invoice.discount_amount || 0,
          items: invoice.items || [
            {
              item_type: 'service',
              item_name: '',
              description: '',
              quantity: 1,
              unit: 'pcs',
              unit_price: 0,
              discount_percentage: 0,
              tax_rate: 16.00
            }
          ]
        });
        setModal(true);
      }
    }
  }, [location.search, invoices]);

  const loadInvoices = async () => {
    try {
      console.log('🔧 Cargando facturas...');
      const response = await fetch('/api/invoices', {
        credentials: 'include',
        headers: {
          'Accept': 'application/json',
        }
      });
      
      console.log('🔧 Response status:', response.status);
      
      if (response.ok) {
        const data = await response.json();
        console.log('🔧 Facturas recibidas:', data);
        setInvoices(data.data || data);
        console.log('🔧 Facturas establecidas en estado');
      } else {
        console.error('🔧 Error en response:', response.status, response.statusText);
        showAlert('Error al cargar las facturas', 'danger');
      }
    } catch (error) {
      console.error('🔧 Error loading invoices:', error);
      showAlert('Error al cargar las facturas', 'danger');
    }
    setLoading(false);
  };

  const loadEquipments = async () => {
    try {
      const response = await fetch('/api/public/equipments', {
        headers: {
          'Accept': 'application/json',
        }
      });
      
      if (response.ok) {
        const data = await response.json();
        setEquipments(data.data || data);
      }
    } catch (error) {
      showAlert('Error al cargar los equipos', 'danger');
    }
  };

  const loadTickets = async () => {
    try {
      const response = await fetch('/api/tickets', {
        credentials: 'include',
        headers: {
          'Accept': 'application/json',
        }
      });
      
      if (response.ok) {
        const data = await response.json();
        setTickets(data.data || data);
      }
    } catch (error) {
      showAlert('Error al cargar los tickets', 'danger');
    }
  };

  const showAlert = (message, color = 'success') => {
    setAlert({ show: true, message, color });
    setTimeout(() => setAlert({ show: false, message: '', color: 'success' }), 5000);
  };

  const openModal = (invoice = null) => {
    if (invoice) {
      setSelectedInvoice(invoice);
      setFormData({
        repair_equipment_id: invoice.repair_equipment_id,
        ticket_id: invoice.ticket_id || '',
        customer_name: invoice.customer_name,
        customer_phone: invoice.customer_phone,
        customer_email: invoice.customer_email || '',
        customer_address: invoice.customer_address || '',
        customer_tax_id: invoice.customer_tax_id || '',
        invoice_date: invoice.invoice_date,
        due_date: invoice.due_date || '',
        payment_method: invoice.payment_method || '',
        notes: invoice.notes || '',
        tax_rate: invoice.tax_rate,
        discount_amount: invoice.discount_amount || 0,
        items: invoice.items || [
          {
            item_type: 'service',
            item_name: '',
            description: '',
            quantity: 1,
            unit: 'pcs',
            unit_price: 0,
            discount_percentage: 0,
            tax_rate: 16.00
          }
        ]
      });
    } else {
      setSelectedInvoice(null);
      setFormData({
        repair_equipment_id: '',
        ticket_id: '',
        customer_name: '',
        customer_phone: '',
        customer_email: '',
        customer_address: '',
        customer_tax_id: '',
        invoice_date: new Date().toISOString().split('T')[0],
        due_date: '',
        payment_method: '',
        notes: '',
        tax_rate: 16.00,
        discount_amount: 0,
        items: [
          {
            item_type: 'service',
            item_name: '',
            description: '',
            quantity: 1,
            unit: 'pcs',
            unit_price: 0,
            discount_percentage: 0,
            tax_rate: 16.00
          }
        ]
      });
    }
    setModal(true);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    try {
      const url = selectedInvoice 
        ? `/api/invoices/${selectedInvoice.id}`
        : '/api/invoices';
      
      const method = selectedInvoice ? 'PUT' : 'POST';
      
      console.log('🔧 Enviando formulario de factura:', {
        url,
        method,
        formData,
        selectedInvoice: selectedInvoice?.id
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
        showAlert(selectedInvoice ? 'Factura actualizada exitosamente' : 'Factura creada exitosamente');
        setModal(false);
        loadInvoices();
      } else {
        const error = await response.json();
        console.error('🔧 Error response:', error);
        showAlert(error.message || 'Error al procesar la solicitud', 'danger');
      }
    } catch (error) {
      console.error('🔧 Error submitting invoice:', error);
      showAlert('Error al procesar la solicitud', 'danger');
    }
  };

  const handleDelete = async (id) => {
    if (window.confirm('¿Estás seguro de que quieres eliminar esta factura?')) {
      try {
        const response = await fetch(`/api/invoices/${id}`, {
          method: 'DELETE',
          credentials: 'include',
          headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
          }
        });

        if (response.ok) {
          showAlert('Factura eliminada exitosamente');
          loadInvoices();
        } else {
          showAlert('Error al eliminar la factura', 'danger');
        }
      } catch (error) {
        console.error('Error deleting invoice:', error);
        showAlert('Error al eliminar la factura', 'danger');
      }
    }
  };

  const markAsPaid = async (id) => {
    const paymentMethod = prompt('Método de pago (cash, card, transfer, check, credit):');
    if (paymentMethod) {
      try {
        const response = await fetch(`/api/invoices/${id}/mark-paid`, {
          method: 'POST',
          credentials: 'include',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
          },
          body: JSON.stringify({ payment_method: paymentMethod })
        });

        if (response.ok) {
          showAlert('Factura marcada como pagada');
          loadInvoices();
        } else {
          showAlert('Error al marcar como pagada', 'danger');
        }
      } catch (error) {
        console.error('Error marking as paid:', error);
        showAlert('Error al marcar como pagada', 'danger');
      }
    }
  };

  const addItem = () => {
    setFormData({
      ...formData,
      items: [
        ...formData.items,
        {
          item_type: 'service',
          item_name: '',
          description: '',
          quantity: 1,
          unit: 'pcs',
          unit_price: 0,
          discount_percentage: 0,
          tax_rate: formData.tax_rate
        }
      ]
    });
  };

  const removeItem = (index) => {
    if (formData.items.length > 1) {
      const newItems = formData.items.filter((_, i) => i !== index);
      setFormData({ ...formData, items: newItems });
    }
  };

  const updateItem = (index, field, value) => {
    const newItems = [...formData.items];
    newItems[index][field] = value;
    setFormData({ ...formData, items: newItems });
  };

  const getStatusBadge = (status) => {
    const colors = {
      draft: 'secondary',
      sent: 'info',
      paid: 'success',
      overdue: 'danger',
      cancelled: 'dark'
    };
    const texts = {
      draft: 'Borrador',
      sent: 'Enviada',
      paid: 'Pagada',
      overdue: 'Vencida',
      cancelled: 'Cancelada'
    };
    return <Badge color={colors[status]}>{texts[status]}</Badge>;
  };

  const formatCurrency = (amount) => {
    return new Intl.NumberFormat('es-MX', {
      style: 'currency',
      currency: 'MXN'
    }).format(amount);
  };

  if (loading) {
    return (
      <Container className="mt--7" fluid>
        <Row>
          <div className="col">
            <Card className="shadow">
              <CardBody>
                <div className="text-center">
                  <div className="spinner-border" role="status">
                    <span className="sr-only">Cargando...</span>
                  </div>
                  <p className="mt-2">Cargando facturas...</p>
                </div>
              </CardBody>
            </Card>
          </div>
        </Row>
      </Container>
    );
  }

  return (
    <>
      <PageHeader 
        title="Gestión de Facturas" 
        subtitle="Administra las facturas del sistema"
        icon="fas fa-file-invoice"
      />
      
      {/* Page content */}
      <Container className="mt--7" fluid>
        <Row>
          <div className="col text-right mb-4">
            <Button
              color="primary"
              onClick={() => openModal()}
              size="sm"
            >
              <i className="fas fa-plus"></i> Nueva Factura
            </Button>
          </div>
        </Row>

        {/* Alert */}
        {alert.show && (
          <UncontrolledAlert color={alert.color} fade={false}>
            {alert.message}
          </UncontrolledAlert>
        )}

        {/* Facturas Table */}
        <Row>
          <div className="col">
            <Card className="shadow">
              <CardHeader className="border-0">
                <h3 className="mb-0">Facturas</h3>
              </CardHeader>
              <CardBody>
                <Table className="align-items-center table-flush" responsive>
                  <thead className="thead-light">
                    <tr>
                      <th scope="col">Número</th>
                      <th scope="col">Cliente</th>
                      <th scope="col">Equipo</th>
                      <th scope="col">Fecha</th>
                      <th scope="col">Total</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    {invoices.map((invoice) => (
                      <tr key={invoice.id}>
                        <td>
                          <span className="font-weight-bold">{invoice.invoice_number}</span>
                        </td>
                        <td>
                          <div>
                            <span className="font-weight-bold">{invoice.customer_name}</span>
                            <br />
                            <small className="text-muted">{invoice.customer_phone}</small>
                          </div>
                        </td>
                        <td>
                          {invoice.repair_equipment ? (
                            <div>
                              <span className="font-weight-bold">
                                {invoice.repair_equipment.brand?.name} {invoice.repair_equipment.model?.name}
                              </span>
                              <br />
                              <small className="text-muted">{invoice.repair_equipment.ticket_number}</small>
                            </div>
                          ) : (
                            <span className="text-muted">Sin equipo</span>
                          )}
                        </td>
                        <td>
                          {new Date(invoice.invoice_date).toLocaleDateString('es-MX')}
                        </td>
                        <td>
                          <span className="font-weight-bold text-success">
                            {formatCurrency(invoice.total_amount)}
                          </span>
                        </td>
                        <td>
                          {getStatusBadge(invoice.status)}
                        </td>
                        <td>
                          <div className="btn-group" role="group">
                            <Button
                              color="info"
                              size="sm"
                              onClick={() => openModal(invoice)}
                            >
                              <i className="fas fa-edit"></i>
                            </Button>
                            {invoice.status !== 'paid' && (
                              <Button
                                color="success"
                                size="sm"
                                onClick={() => markAsPaid(invoice.id)}
                              >
                                <i className="fas fa-check"></i>
                              </Button>
                            )}
                            <Button
                              color="danger"
                              size="sm"
                              onClick={() => handleDelete(invoice.id)}
                            >
                              <i className="fas fa-trash"></i>
                            </Button>
                          </div>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </Table>
              </CardBody>
            </Card>
          </div>
        </Row>
      </Container>

      {/* Modal para crear/editar factura */}
      <Modal isOpen={modal} toggle={() => setModal(false)} size="xl">
        <ModalHeader toggle={() => setModal(false)}>
          {selectedInvoice ? 'Editar Factura' : 'Nueva Factura'}
        </ModalHeader>
        <ModalBody>
          <Form onSubmit={handleSubmit}>
            <Row>
              <Col md="6">
                <FormGroup>
                  <Label>Equipo de Reparación *</Label>
                  <Input
                    type="select"
                    value={formData.repair_equipment_id}
                    onChange={(e) => setFormData({...formData, repair_equipment_id: e.target.value})}
                    required
                  >
                    <option value="">Seleccionar equipo...</option>
                    {equipments.map(equipment => (
                      <option key={equipment.id} value={equipment.id}>
                        {equipment.ticket_number} - {equipment.customer_name} - {equipment.brand?.name} {equipment.model?.name}
                      </option>
                    ))}
                  </Input>
                </FormGroup>
              </Col>
              <Col md="6">
                <FormGroup>
                  <Label>Ticket (Opcional)</Label>
                  <Input
                    type="select"
                    value={formData.ticket_id}
                    onChange={(e) => setFormData({...formData, ticket_id: e.target.value})}
                  >
                    <option value="">Sin ticket</option>
                    {tickets.map(ticket => (
                      <option key={ticket.id} value={ticket.id}>
                        {ticket.ticket_number} - {ticket.title}
                      </option>
                    ))}
                  </Input>
                </FormGroup>
              </Col>
            </Row>

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
                    type="text"
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
                  <Label>RFC/NIT</Label>
                  <Input
                    type="text"
                    value={formData.customer_tax_id}
                    onChange={(e) => setFormData({...formData, customer_tax_id: e.target.value})}
                  />
                </FormGroup>
              </Col>
            </Row>

            <Row>
              <Col md="6">
                <FormGroup>
                  <Label>Fecha de Factura *</Label>
                  <Input
                    type="date"
                    value={formData.invoice_date}
                    onChange={(e) => setFormData({...formData, invoice_date: e.target.value})}
                    required
                  />
                </FormGroup>
              </Col>
              <Col md="6">
                <FormGroup>
                  <Label>Fecha de Vencimiento</Label>
                  <Input
                    type="date"
                    value={formData.due_date}
                    onChange={(e) => setFormData({...formData, due_date: e.target.value})}
                  />
                </FormGroup>
              </Col>
            </Row>

            <Row>
              <Col md="6">
                <FormGroup>
                  <Label>Método de Pago</Label>
                  <Input
                    type="select"
                    value={formData.payment_method}
                    onChange={(e) => setFormData({...formData, payment_method: e.target.value})}
                  >
                    <option value="">Seleccionar método...</option>
                    <option value="cash">Efectivo</option>
                    <option value="card">Tarjeta</option>
                    <option value="transfer">Transferencia</option>
                    <option value="check">Cheque</option>
                    <option value="credit">Crédito</option>
                  </Input>
                </FormGroup>
              </Col>
              <Col md="6">
                <FormGroup>
                  <Label>% de Impuesto</Label>
                  <Input
                    type="number"
                    step="0.01"
                    value={formData.tax_rate}
                    onChange={(e) => setFormData({...formData, tax_rate: parseFloat(e.target.value)})}
                  />
                </FormGroup>
              </Col>
            </Row>

            <FormGroup>
              <Label>Dirección del Cliente</Label>
              <Input
                type="textarea"
                value={formData.customer_address}
                onChange={(e) => setFormData({...formData, customer_address: e.target.value})}
                rows="2"
              />
            </FormGroup>

            <FormGroup>
              <Label>Notas</Label>
              <Input
                type="textarea"
                value={formData.notes}
                onChange={(e) => setFormData({...formData, notes: e.target.value})}
                rows="2"
              />
            </FormGroup>

            {/* Items de la factura */}
            <div className="mb-4">
              <div className="d-flex justify-content-between align-items-center mb-3">
                <h5>Items de la Factura</h5>
                <Button color="primary" size="sm" onClick={addItem}>
                  <i className="fas fa-plus"></i> Agregar Item
                </Button>
              </div>

              {formData.items.map((item, index) => (
                <Card key={index} className="mb-3">
                  <CardBody>
                    <Row>
                      <Col md="3">
                        <FormGroup>
                          <Label>Tipo</Label>
                          <Input
                            type="select"
                            value={item.item_type}
                            onChange={(e) => updateItem(index, 'item_type', e.target.value)}
                          >
                            <option value="service">Servicio</option>
                            <option value="product">Producto</option>
                            <option value="part">Repuesto</option>
                          </Input>
                        </FormGroup>
                      </Col>
                      <Col md="4">
                        <FormGroup>
                          <Label>Nombre *</Label>
                          <Input
                            type="text"
                            value={item.item_name}
                            onChange={(e) => updateItem(index, 'item_name', e.target.value)}
                            required
                          />
                        </FormGroup>
                      </Col>
                      <Col md="2">
                        <FormGroup>
                          <Label>Cantidad *</Label>
                          <Input
                            type="number"
                            step="0.01"
                            value={item.quantity}
                            onChange={(e) => updateItem(index, 'quantity', parseFloat(e.target.value))}
                            required
                          />
                        </FormGroup>
                      </Col>
                      <Col md="2">
                        <FormGroup>
                          <Label>Precio Unit. *</Label>
                          <Input
                            type="number"
                            step="0.01"
                            value={item.unit_price}
                            onChange={(e) => updateItem(index, 'unit_price', parseFloat(e.target.value))}
                            required
                          />
                        </FormGroup>
                      </Col>
                      <Col md="1">
                        <FormGroup>
                          <Label>&nbsp;</Label>
                          <div>
                            {formData.items.length > 1 && (
                              <Button
                                color="danger"
                                size="sm"
                                onClick={() => removeItem(index)}
                              >
                                <i className="fas fa-trash"></i>
                              </Button>
                            )}
                          </div>
                        </FormGroup>
                      </Col>
                    </Row>
                    <Row>
                      <Col md="6">
                        <FormGroup>
                          <Label>Descripción</Label>
                          <Input
                            type="textarea"
                            value={item.description}
                            onChange={(e) => updateItem(index, 'description', e.target.value)}
                            rows="2"
                          />
                        </FormGroup>
                      </Col>
                      <Col md="3">
                        <FormGroup>
                          <Label>Unidad</Label>
                          <Input
                            type="text"
                            value={item.unit}
                            onChange={(e) => updateItem(index, 'unit', e.target.value)}
                          />
                        </FormGroup>
                      </Col>
                      <Col md="3">
                        <FormGroup>
                          <Label>% Descuento</Label>
                          <Input
                            type="number"
                            step="0.01"
                            value={item.discount_percentage}
                            onChange={(e) => updateItem(index, 'discount_percentage', parseFloat(e.target.value))}
                          />
                        </FormGroup>
                      </Col>
                    </Row>
                  </CardBody>
                </Card>
              ))}
            </div>

            <div className="text-right">
              <Button color="secondary" className="mr-2" onClick={() => setModal(false)}>
                Cancelar
              </Button>
              <Button color="primary" type="submit">
                {selectedInvoice ? 'Actualizar' : 'Crear'} Factura
              </Button>
            </div>
          </Form>
        </ModalBody>
      </Modal>
    </>
  );
};

export default InvoiceManagement;

