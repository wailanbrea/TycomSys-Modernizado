/*!
=========================================================
* TicomSys - Sistema de Gestión de Reparaciones
=========================================================
* Vista de Facturas Registradas
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
  Container,
  Row,
  Col,
  Button,
  Table,
  Badge,
  Input,
  FormGroup,
  Label,
  UncontrolledAlert,
  Modal,
  ModalHeader,
  ModalBody
} from "reactstrap";

const InvoiceView = () => {
  const location = useLocation();
  const [invoices, setInvoices] = useState([]);
  const [filteredInvoices, setFilteredInvoices] = useState([]);
  const [loading, setLoading] = useState(true);
  const [selectedInvoice, setSelectedInvoice] = useState(null);
  const [printModal, setPrintModal] = useState(false);
  const [modalMode, setModalMode] = useState('print'); // 'print' o 'view'
  const [completeModal, setCompleteModal] = useState(false);
  const [paymentData, setPaymentData] = useState({
    payment_method: '',
    payment_reference: '',
    payment_notes: ''
  });
  const [alert, setAlert] = useState({ show: false, message: '', color: 'success' });
  const [filters, setFilters] = useState({
    status: '',
    dateFrom: '',
    dateTo: '',
    customer: ''
  });

  useEffect(() => {
    loadInvoices();
  }, []);

  useEffect(() => {
    // Verificar si hay un parámetro de consulta con el ID de la factura
    const urlParams = new URLSearchParams(location.search);
    const invoiceId = urlParams.get('id');
    
    if (invoiceId && invoices.length > 0) {
      const invoice = invoices.find(inv => inv.id === parseInt(invoiceId));
      if (invoice && !selectedInvoice) {
        setSelectedInvoice(invoice);
        setModalMode('view');
        setPrintModal(true);
      }
    }
  }, [location.search, invoices, selectedInvoice]);

  useEffect(() => {
    filterInvoices();
  }, [invoices, filters]);

  const loadInvoices = async () => {
    try {
      console.log('🔧 Cargando facturas para vista...');
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

  const filterInvoices = () => {
    let filtered = [...invoices];

    if (filters.status) {
      filtered = filtered.filter(invoice => invoice.status === filters.status);
    }

    if (filters.dateFrom) {
      filtered = filtered.filter(invoice => 
        new Date(invoice.invoice_date) >= new Date(filters.dateFrom)
      );
    }

    if (filters.dateTo) {
      filtered = filtered.filter(invoice => 
        new Date(invoice.invoice_date) <= new Date(filters.dateTo)
      );
    }

    if (filters.customer) {
      filtered = filtered.filter(invoice => 
        invoice.customer_name.toLowerCase().includes(filters.customer.toLowerCase())
      );
    }

    setFilteredInvoices(filtered);
  };

  const showAlert = (message, color = 'success') => {
    setAlert({ show: true, message, color });
    setTimeout(() => setAlert({ show: false, message: '', color: 'success' }), 5000);
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

  const formatDate = (date) => {
    return new Date(date).toLocaleDateString('es-MX');
  };

  const openPrintModal = (invoice) => {
    setSelectedInvoice(invoice);
    setModalMode('print');
    setPrintModal(true);
  };

  const openViewModal = (invoice) => {
    setSelectedInvoice(invoice);
    setModalMode('view');
    setPrintModal(true);
  };

  const openCompleteModal = (invoice) => {
    setSelectedInvoice(invoice);
    setPaymentData({
      payment_method: '',
      payment_reference: '',
      payment_notes: ''
    });
    setCompleteModal(true);
  };

  const markAsPaid = async () => {
    if (!paymentData.payment_method) {
      showAlert('Por favor selecciona un método de pago', 'danger');
      return;
    }

    try {
      const response = await fetch(`/api/invoices/${selectedInvoice.id}/mark-paid`, {
        method: 'POST',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify(paymentData)
      });

      if (response.ok) {
        showAlert('Factura marcada como pagada');
        loadInvoices();
        setCompleteModal(false);
        setPrintModal(false);
      } else {
        showAlert('Error al marcar como pagada', 'danger');
      }
    } catch (error) {
      console.error('Error marking as paid:', error);
      showAlert('Error al marcar como pagada', 'danger');
    }
  };

  const printInvoice = () => {
    const printWindow = window.open('', '_blank');
    const invoice = selectedInvoice;
    
    const printContent = `
      <!DOCTYPE html>
      <html lang="es">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Factura ${invoice.invoice_number}</title>
        <style>
          body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: white;
          }
          .invoice-header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
          }
          .company-info {
            margin-bottom: 20px;
          }
          .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
          }
          .customer-info, .invoice-info {
            width: 45%;
          }
          .invoice-info {
            text-align: right;
          }
          .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
          }
          .items-table th,
          .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
          }
          .items-table th {
            background-color: #f2f2f2;
            font-weight: bold;
          }
          .totals {
            text-align: right;
            margin-top: 20px;
          }
          .total-row {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
          }
          .total-final {
            font-weight: bold;
            font-size: 1.2em;
            border-top: 2px solid #333;
            padding-top: 10px;
          }
          .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
          }
          @media print {
            body { margin: 0; }
            .no-print { display: none; }
          }
        </style>
      </head>
      <body>
        <div class="invoice-header">
          <h1>TicomSys</h1>
          <h2>Sistema de Gestión de Reparaciones</h2>
          <p>FACTURA</p>
        </div>

        <div class="company-info">
          <h3>TicomSys</h3>
          <p>Dirección: [Dirección de la empresa]</p>
          <p>Teléfono: [Teléfono de la empresa]</p>
          <p>Email: [Email de la empresa]</p>
          <p>RFC: [RFC de la empresa]</p>
        </div>

        <div class="invoice-details">
          <div class="customer-info">
            <h4>Datos del Cliente:</h4>
            <p><strong>Nombre:</strong> ${invoice.customer_name}</p>
            <p><strong>Teléfono:</strong> ${invoice.customer_phone}</p>
            ${invoice.customer_email ? `<p><strong>Email:</strong> ${invoice.customer_email}</p>` : ''}
            ${invoice.customer_address ? `<p><strong>Dirección:</strong> ${invoice.customer_address}</p>` : ''}
            ${invoice.customer_tax_id ? `<p><strong>RFC/NIT:</strong> ${invoice.customer_tax_id}</p>` : ''}
          </div>
          
          <div class="invoice-info">
            <h4>Datos de la Factura:</h4>
            <p><strong>Número:</strong> ${invoice.invoice_number}</p>
            <p><strong>Fecha:</strong> ${formatDate(invoice.invoice_date)}</p>
            ${invoice.due_date ? `<p><strong>Vencimiento:</strong> ${formatDate(invoice.due_date)}</p>` : ''}
            <p><strong>Estado:</strong> ${getStatusBadge(invoice.status).props.children}</p>
            ${invoice.payment_method ? `<p><strong>Método de Pago:</strong> ${invoice.payment_method}</p>` : ''}
          </div>
        </div>

        <table class="items-table">
          <thead>
            <tr>
              <th>Tipo</th>
              <th>Descripción</th>
              <th>Cantidad</th>
              <th>Unidad</th>
              <th>Precio Unit.</th>
              <th>Descuento</th>
              <th>Impuesto</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            ${invoice.items ? invoice.items.map(item => `
              <tr>
                <td>${item.item_type === 'service' ? 'Servicio' : item.item_type === 'product' ? 'Producto' : 'Repuesto'}</td>
                <td>${item.item_name}<br><small>${item.description || ''}</small></td>
                <td>${item.quantity}</td>
                <td>${item.unit}</td>
                <td>${formatCurrency(item.unit_price)}</td>
                <td>${item.discount_percentage}%</td>
                <td>${item.tax_rate}%</td>
                <td>${formatCurrency(item.total_amount)}</td>
              </tr>
            `).join('') : ''}
          </tbody>
        </table>

        <div class="totals">
          <div class="total-row">
            <span>Subtotal:</span>
            <span>${formatCurrency(invoice.subtotal)}</span>
          </div>
          ${invoice.discount_amount > 0 ? `
            <div class="total-row">
              <span>Descuento:</span>
              <span>-${formatCurrency(invoice.discount_amount)}</span>
            </div>
          ` : ''}
          <div class="total-row">
            <span>Impuestos (${invoice.tax_rate}%):</span>
            <span>${formatCurrency(invoice.tax_amount)}</span>
          </div>
          <div class="total-row total-final">
            <span>TOTAL:</span>
            <span>${formatCurrency(invoice.total_amount)}</span>
          </div>
        </div>

        ${invoice.notes ? `
          <div style="margin-top: 30px;">
            <h4>Notas:</h4>
            <p>${invoice.notes}</p>
          </div>
        ` : ''}

        <div class="footer">
          <p>Gracias por su preferencia</p>
          <p>Esta factura fue generada el ${new Date().toLocaleString('es-MX')}</p>
        </div>

        <script>
          window.onload = function() {
            window.print();
            window.onafterprint = function() {
              window.close();
            };
          };
        </script>
      </body>
      </html>
    `;

    printWindow.document.write(printContent);
    printWindow.document.close();
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
        title="Facturas Registradas" 
        subtitle="Visualiza y gestiona todas las facturas del sistema"
        icon="fas fa-file-invoice-dollar"
      />
      
      {/* Page content */}
      <Container className="mt--7" fluid>
        <Row>
          <div className="col text-right mb-4">
            <Button
              color="info"
              onClick={() => window.print()}
              size="sm"
            >
              <i className="fas fa-print"></i> Imprimir Lista
            </Button>
          </div>
        </Row>

        {/* Alert */}
        {alert.show && (
          <UncontrolledAlert color={alert.color} fade={false}>
            {alert.message}
          </UncontrolledAlert>
        )}

        {/* Filtros */}
        <Row>
          <div className="col">
            <Card className="shadow">
              <CardHeader className="border-0">
                <h3 className="mb-0">Filtros</h3>
              </CardHeader>
              <CardBody>
                <Row>
                  <Col md="3">
                    <FormGroup>
                      <Label>Estado</Label>
                      <Input
                        type="select"
                        value={filters.status}
                        onChange={(e) => setFilters({...filters, status: e.target.value})}
                      >
                        <option value="">Todos los estados</option>
                        <option value="draft">Borrador</option>
                        <option value="sent">Enviada</option>
                        <option value="paid">Pagada</option>
                        <option value="overdue">Vencida</option>
                        <option value="cancelled">Cancelada</option>
                      </Input>
                    </FormGroup>
                  </Col>
                  <Col md="3">
                    <FormGroup>
                      <Label>Fecha Desde</Label>
                      <Input
                        type="date"
                        value={filters.dateFrom}
                        onChange={(e) => setFilters({...filters, dateFrom: e.target.value})}
                      />
                    </FormGroup>
                  </Col>
                  <Col md="3">
                    <FormGroup>
                      <Label>Fecha Hasta</Label>
                      <Input
                        type="date"
                        value={filters.dateTo}
                        onChange={(e) => setFilters({...filters, dateTo: e.target.value})}
                      />
                    </FormGroup>
                  </Col>
                  <Col md="3">
                    <FormGroup>
                      <Label>Cliente</Label>
                      <Input
                        type="text"
                        placeholder="Buscar por nombre..."
                        value={filters.customer}
                        onChange={(e) => setFilters({...filters, customer: e.target.value})}
                      />
                    </FormGroup>
                  </Col>
                </Row>
              </CardBody>
            </Card>
          </div>
        </Row>

        {/* Facturas Table */}
        <Row>
          <div className="col">
            <Card className="shadow">
              <CardHeader className="border-0">
                <h3 className="mb-0">
                  Facturas ({filteredInvoices.length})
                  <small className="text-muted ml-2">
                    Total: {formatCurrency(filteredInvoices.reduce((sum, inv) => sum + inv.total_amount, 0))}
                  </small>
                </h3>
              </CardHeader>
              <CardBody>
                <Table className="align-items-center table-flush" responsive>
                  <thead className="thead-light">
                    <tr>
                      <th scope="col">Número</th>
                      <th scope="col">Cliente</th>
                      <th scope="col">Equipo</th>
                      <th scope="col">Fecha</th>
                      <th scope="col">Vencimiento</th>
                      <th scope="col">Total</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    {filteredInvoices.map((invoice) => (
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
                          {formatDate(invoice.invoice_date)}
                        </td>
                        <td>
                          {invoice.due_date ? formatDate(invoice.due_date) : '-'}
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
                              color="primary"
                              size="sm"
                              onClick={() => openPrintModal(invoice)}
                              title="Imprimir Factura"
                            >
                              <i className="fas fa-print"></i>
                            </Button>
                            <Button
                              color="info"
                              size="sm"
                              onClick={() => openViewModal(invoice)}
                              title="Ver Detalles"
                            >
                              <i className="fas fa-eye"></i>
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

      {/* Modal de confirmación de impresión o vista de detalles */}
      <Modal isOpen={printModal} toggle={() => setPrintModal(false)} size={modalMode === 'view' ? 'xl' : 'md'}>
        <ModalHeader toggle={() => setPrintModal(false)}>
          {modalMode === 'print' ? 'Imprimir Factura' : 'Detalles de la Factura'}
        </ModalHeader>
        <ModalBody>
          {selectedInvoice && (
            <div>
              {modalMode === 'print' ? (
                // Modo impresión
                <div>
                  <p>¿Desea imprimir la factura <strong>{selectedInvoice.invoice_number}</strong>?</p>
                  <p><strong>Cliente:</strong> {selectedInvoice.customer_name}</p>
                  <p><strong>Total:</strong> {formatCurrency(selectedInvoice.total_amount)}</p>
                  <p><strong>Estado:</strong> {getStatusBadge(selectedInvoice.status).props.children}</p>
                  
                  <div className="text-right mt-3">
                    <Button color="secondary" className="mr-2" onClick={() => setPrintModal(false)}>
                      Cancelar
                    </Button>
                    <Button color="primary" onClick={printInvoice}>
                      <i className="fas fa-print"></i> Imprimir
                    </Button>
                  </div>
                </div>
              ) : (
                // Modo vista de detalles
                <div>
                  <Row>
                    <Col md="6">
                      <h5>Información de la Factura</h5>
                      <p><strong>Número:</strong> {selectedInvoice.invoice_number}</p>
                      <p><strong>Fecha:</strong> {formatDate(selectedInvoice.invoice_date)}</p>
                      <p><strong>Vencimiento:</strong> {selectedInvoice.due_date ? formatDate(selectedInvoice.due_date) : 'No especificado'}</p>
                      <p><strong>Estado:</strong> {getStatusBadge(selectedInvoice.status)}</p>
                      <p><strong>Método de Pago:</strong> {selectedInvoice.payment_method || 'No especificado'}</p>
                      {selectedInvoice.paid_date && (
                        <p><strong>Fecha de Pago:</strong> {formatDate(selectedInvoice.paid_date)}</p>
                      )}
                    </Col>
                    <Col md="6">
                      <h5>Información del Cliente</h5>
                      <p><strong>Nombre:</strong> {selectedInvoice.customer_name}</p>
                      <p><strong>Teléfono:</strong> {selectedInvoice.customer_phone}</p>
                      {selectedInvoice.customer_email && (
                        <p><strong>Email:</strong> {selectedInvoice.customer_email}</p>
                      )}
                      {selectedInvoice.customer_address && (
                        <p><strong>Dirección:</strong> {selectedInvoice.customer_address}</p>
                      )}
                      {selectedInvoice.customer_tax_id && (
                        <p><strong>RFC/NIT:</strong> {selectedInvoice.customer_tax_id}</p>
                      )}
                    </Col>
                  </Row>

                  {selectedInvoice.repair_equipment && (
                    <Row className="mt-3">
                      <Col md="12">
                        <h5>Equipo de Reparación</h5>
                        <p><strong>Ticket:</strong> {selectedInvoice.repair_equipment.ticket_number}</p>
                        <p><strong>Equipo:</strong> {selectedInvoice.repair_equipment.brand?.name} {selectedInvoice.repair_equipment.model?.name}</p>
                        <p><strong>Número de Serie:</strong> {selectedInvoice.repair_equipment.serial_number || 'No especificado'}</p>
                      </Col>
                    </Row>
                  )}

                  {selectedInvoice.items && selectedInvoice.items.length > 0 && (
                    <Row className="mt-3">
                      <Col md="12">
                        <h5>Items de la Factura</h5>
                        <Table size="sm" responsive>
                          <thead>
                            <tr>
                              <th>Tipo</th>
                              <th>Descripción</th>
                              <th>Cantidad</th>
                              <th>Precio Unit.</th>
                              <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            {selectedInvoice.items.map((item, index) => (
                              <tr key={index}>
                                <td>
                                  <Badge color={
                                    item.item_type === 'service' ? 'primary' : 
                                    item.item_type === 'product' ? 'success' : 'warning'
                                  }>
                                    {item.item_type === 'service' ? 'Servicio' : 
                                     item.item_type === 'product' ? 'Producto' : 'Repuesto'}
                                  </Badge>
                                </td>
                                <td>
                                  <div>
                                    <strong>{item.item_name}</strong>
                                    {item.description && (
                                      <div><small className="text-muted">{item.description}</small></div>
                                    )}
                                  </div>
                                </td>
                                <td>{item.quantity} {item.unit}</td>
                                <td>{formatCurrency(item.unit_price)}</td>
                                <td>{formatCurrency(item.total_amount)}</td>
                              </tr>
                            ))}
                          </tbody>
                        </Table>
                      </Col>
                    </Row>
                  )}

                  <Row className="mt-3">
                    <Col md="12">
                      <div className="text-right">
                        <h5>Totales</h5>
                        <p><strong>Subtotal:</strong> {formatCurrency(selectedInvoice.subtotal)}</p>
                        {selectedInvoice.discount_amount > 0 && (
                          <p><strong>Descuento:</strong> -{formatCurrency(selectedInvoice.discount_amount)}</p>
                        )}
                        <p><strong>Impuestos ({selectedInvoice.tax_rate}%):</strong> {formatCurrency(selectedInvoice.tax_amount)}</p>
                        <hr />
                        <h4><strong>Total: {formatCurrency(selectedInvoice.total_amount)}</strong></h4>
                      </div>
                    </Col>
                  </Row>

                  {selectedInvoice.notes && (
                    <Row className="mt-3">
                      <Col md="12">
                        <h5>Notas</h5>
                        <p>{selectedInvoice.notes}</p>
                      </Col>
                    </Row>
                  )}

                  <div className="text-right mt-3">
                    <Button color="secondary" className="mr-2" onClick={() => setPrintModal(false)}>
                      Cerrar
                    </Button>
                    
                    {selectedInvoice.status === 'draft' && (
                      <>
                        <Button color="info" className="mr-2" onClick={() => window.location.href = `/admin/invoices?edit=${selectedInvoice.id}`}>
                          <i className="fas fa-edit"></i> Editar Factura
                        </Button>
                        <Button color="warning" className="mr-2" onClick={() => openCompleteModal(selectedInvoice)}>
                          <i className="fas fa-check"></i> Completar Factura
                        </Button>
                      </>
                    )}
                    
                    <Button color="primary" onClick={() => {
                      setModalMode('print');
                      printInvoice();
                    }}>
                      <i className="fas fa-print"></i> Imprimir
                    </Button>
                  </div>
                </div>
              )}
            </div>
          )}
        </ModalBody>
      </Modal>

      {/* Modal para Completar Factura */}
      <Modal isOpen={completeModal} toggle={() => setCompleteModal(false)} size="md">
        <ModalHeader toggle={() => setCompleteModal(false)}>
          Completar Factura - {selectedInvoice?.invoice_number}
        </ModalHeader>
        <ModalBody>
          {selectedInvoice && (
            <div>
              <Row>
                <Col md="12">
                  <h5>Resumen de la Factura</h5>
                  <p><strong>Cliente:</strong> {selectedInvoice.customer_name}</p>
                  <p><strong>Total:</strong> {formatCurrency(selectedInvoice.total_amount)}</p>
                  <p><strong>Fecha:</strong> {formatDate(selectedInvoice.invoice_date)}</p>
                  <hr />
                </Col>
              </Row>

              <Row>
                <Col md="12">
                  <FormGroup>
                    <Label>Método de Pago *</Label>
                    <Input
                      type="select"
                      value={paymentData.payment_method}
                      onChange={(e) => setPaymentData({...paymentData, payment_method: e.target.value})}
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
              </Row>

              <Row>
                <Col md="12">
                  <FormGroup>
                    <Label>Referencia de Pago</Label>
                    <Input
                      type="text"
                      placeholder="Ej: TRANS-123456, CHK-789"
                      value={paymentData.payment_reference}
                      onChange={(e) => setPaymentData({...paymentData, payment_reference: e.target.value})}
                    />
                  </FormGroup>
                </Col>
              </Row>

              <Row>
                <Col md="12">
                  <FormGroup>
                    <Label>Notas de Pago</Label>
                    <Input
                      type="textarea"
                      rows="3"
                      placeholder="Notas adicionales sobre el pago..."
                      value={paymentData.payment_notes}
                      onChange={(e) => setPaymentData({...paymentData, payment_notes: e.target.value})}
                    />
                  </FormGroup>
                </Col>
              </Row>

              <div className="text-right mt-3">
                <Button color="secondary" className="mr-2" onClick={() => setCompleteModal(false)}>
                  Cancelar
                </Button>
                <Button color="success" onClick={markAsPaid}>
                  <i className="fas fa-check"></i> Marcar como Pagada
                </Button>
              </div>
            </div>
          )}
        </ModalBody>
      </Modal>
    </>
  );
};

export default InvoiceView;
