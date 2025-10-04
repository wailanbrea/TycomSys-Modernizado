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
  UncontrolledCollapse,
} from "reactstrap";
// core components
import { useState, useEffect } from "react";

const RoleManagement = () => {
  const [roles, setRoles] = useState([]);
  const [permissions, setPermissions] = useState([]);
  const [loading, setLoading] = useState(true);
  const [modal, setModal] = useState(false);
  const [editModal, setEditModal] = useState(false);
  const [selectedRole, setSelectedRole] = useState(null);
  const [selectedPermissions, setSelectedPermissions] = useState([]);
  const [editFormData, setEditFormData] = useState({
    name: '',
    display_name: '',
    description: ''
  });

  useEffect(() => {
    loadRoles();
    loadPermissions();
  }, []);

  const loadRoles = async () => {
    try {
      const response = await fetch('/api/roles');
      if (response.ok) {
        const data = await response.json();
        setRoles(data);
      }
    } catch (error) {
      console.error('Error loading roles:', error);
    }
    setLoading(false);
  };

  const loadPermissions = async () => {
    try {
      const response = await fetch('/api/permissions');
      if (response.ok) {
        const data = await response.json();
        setPermissions(data);
      }
    } catch (error) {
      console.error('Error loading permissions:', error);
    }
  };

  const handlePermissionToggle = (permissionId) => {
    setSelectedPermissions(prev => {
      if (prev.includes(permissionId)) {
        return prev.filter(id => id !== permissionId);
      } else {
        return [...prev, permissionId];
      }
    });
  };

  const openModal = (role) => {
    setSelectedRole(role);
    setSelectedPermissions(role.permissions?.map(p => p.id) || []);
    setModal(true);
  };

  const openEditModal = (role) => {
    setSelectedRole(role);
    setEditFormData({
      name: role.name,
      display_name: role.display_name,
      description: role.description || ''
    });
    setEditModal(true);
  };

  const handleEditSubmit = async (e) => {
    e.preventDefault();
    
    try {
      const response = await fetch(`/api/roles/${selectedRole.id}`, {
        method: 'PUT',
        credentials: 'include',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify(editFormData)
      });

      if (response.ok) {
        setEditModal(false);
        loadRoles(); // Recargar la lista de roles
        alert('Rol actualizado exitosamente');
      } else {
        const error = await response.json();
        alert('Error al actualizar el rol: ' + (error.message || 'Error desconocido'));
      }
    } catch (error) {
      console.error('Error updating role:', error);
      alert('Error al actualizar el rol');
    }
  };

  if (loading) {
    return (
      <Container className="mt--7" fluid>
        <Row>
          <Col>
            <Alert color="info">Cargando roles...</Alert>
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
                <h1 className="display-2 text-white">Gestión de Roles</h1>
                <p className="text-white mt-0 mb-5">
                  Administra roles y permisos del sistema
                </p>
              </div>
            </Row>
          </div>
        </Container>
      </div>
      
      {/* Page content */}
      <Container className="mt--7" fluid>
        {/* Roles Table */}
        <Row>
          <div className="col">
            <Card className="shadow">
              <CardHeader className="border-0">
                <Row className="align-items-center">
                  <Col>
                    <h3 className="mb-0">Gestión de Roles y Permisos</h3>
                  </Col>
                  <Col className="text-right">
                    <Button color="primary" size="sm">
                      <i className="ni ni-fat-add mr-1" />
                      Nuevo Rol
                    </Button>
                  </Col>
                </Row>
              </CardHeader>
              <Table className="align-items-center table-flush" responsive>
                <thead className="thead-light">
                  <tr>
                    <th scope="col">Rol</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Permisos</th>
                    <th scope="col">Usuarios</th>
                    <th scope="col">Acciones</th>
                    <th scope="col" />
                  </tr>
                </thead>
                <tbody>
                  {roles.map((role) => (
                    <tr key={role.id}>
                      <th scope="row">
                        <Media className="align-items-center">
                          <div className="avatar bg-primary rounded-circle mr-3">
                            <i className="ni ni-badge text-white" />
                          </div>
                          <Media>
                            <span className="mb-0 text-sm font-weight-bold">
                              {role.display_name}
                            </span>
                            <br />
                            <span className="text-muted text-sm">
                              {role.name}
                            </span>
                          </Media>
                        </Media>
                      </th>
                      <td>
                        <span className="text-sm">
                          {role.description}
                        </span>
                      </td>
                      <td>
                        <div className="d-flex flex-wrap">
                          {role.permissions?.slice(0, 3).map((permission) => (
                            <Badge key={permission.id} color="success" className="mr-1 mb-1">
                              {permission.display_name}
                            </Badge>
                          ))}
                          {role.permissions?.length > 3 && (
                            <Badge color="info" className="mr-1 mb-1">
                              +{role.permissions.length - 3} más
                            </Badge>
                          )}
                        </div>
                      </td>
                      <td>
                        <span className="text-sm">
                          {(role.users_count ?? role.users?.length ?? 0)} usuarios
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
                                openModal(role);
                              }}
                            >
                              <i className="ni ni-key-25 mr-2" />
                              Gestionar Permisos
                            </DropdownItem>
                            <DropdownItem
                              href="#pablo"
                              onClick={(e) => {
                                e.preventDefault();
                                openEditModal(role);
                              }}
                            >
                              <i className="ni ni-settings-gear-65 mr-2" />
                              Editar Rol
                            </DropdownItem>
                            <DropdownItem
                              href="#pablo"
                              onClick={(e) => e.preventDefault()}
                            >
                              <i className="ni ni-fat-remove mr-2" />
                              Eliminar Rol
                            </DropdownItem>
                          </DropdownMenu>
                        </UncontrolledDropdown>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </Table>
            </Card>
          </div>
        </Row>

        {/* Permissions Overview */}
        <Row className="mt-5">
          <div className="col">
            <Card className="bg-default shadow">
              <CardHeader className="bg-transparent border-0">
                <h3 className="text-white mb-0">Todos los Permisos del Sistema</h3>
              </CardHeader>
              <Table
                className="align-items-center table-dark table-flush"
                responsive
              >
                <thead className="thead-dark">
                  <tr>
                    <th scope="col">Permiso</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Roles que lo tienen</th>
                    <th scope="col" />
                  </tr>
                </thead>
                <tbody>
                  {permissions.map((permission) => (
                    <tr key={permission.id}>
                      <th scope="row">
                        <Media className="align-items-center">
                          <div className="avatar bg-success rounded-circle mr-3">
                            <i className="ni ni-key-25 text-white" />
                          </div>
                          <Media>
                            <span className="mb-0 text-sm font-weight-bold">
                              {permission.display_name}
                            </span>
                            <br />
                            <span className="text-muted text-sm">
                              {permission.name}
                            </span>
                          </Media>
                        </Media>
                      </th>
                      <td>
                        <span className="text-sm">
                          {permission.description}
                        </span>
                      </td>
                      <td>
                        <span className="text-sm">
                          {permission.roles?.length || 0} roles
                        </span>
                      </td>
                      <td className="text-right">
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
                              onClick={(e) => e.preventDefault()}
                            >
                              Ver Detalles
                            </DropdownItem>
                            <DropdownItem
                              href="#pablo"
                              onClick={(e) => e.preventDefault()}
                            >
                              Editar Permiso
                            </DropdownItem>
                          </DropdownMenu>
                        </UncontrolledDropdown>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </Table>
            </Card>
          </div>
        </Row>

        {/* Modal para gestionar permisos de rol */}
        <Modal isOpen={modal} toggle={() => setModal(false)} size="lg">
          <ModalHeader toggle={() => setModal(false)}>
            Gestionar Permisos - {selectedRole?.display_name}
          </ModalHeader>
          <ModalBody>
            <Form>
              <FormGroup>
                <Label>Seleccionar Permisos</Label>
                <div className="border rounded p-3" style={{maxHeight: '400px', overflowY: 'auto'}}>
                  {permissions.map((permission) => (
                    <div key={permission.id} className="form-check mb-2">
                      <Input
                        type="checkbox"
                        id={`permission-${permission.id}`}
                        checked={selectedPermissions.includes(permission.id)}
                        onChange={() => handlePermissionToggle(permission.id)}
                      />
                      <Label check for={`permission-${permission.id}`} className="ml-2">
                        <strong>{permission.display_name}</strong>
                        <br />
                        <small className="text-muted">{permission.description}</small>
                      </Label>
                    </div>
                  ))}
                </div>
              </FormGroup>
            </Form>
          </ModalBody>
          <ModalFooter>
            <Button color="primary">
              Guardar Permisos
            </Button>
            <Button color="secondary" onClick={() => setModal(false)}>
              Cancelar
            </Button>
          </ModalFooter>
        </Modal>

        {/* Modal para editar rol */}
        <Modal isOpen={editModal} toggle={() => setEditModal(false)}>
          <ModalHeader toggle={() => setEditModal(false)}>
            Editar Rol - {selectedRole?.display_name}
          </ModalHeader>
          <ModalBody>
            <Form onSubmit={handleEditSubmit}>
              <FormGroup>
                <Label>Nombre del Rol *</Label>
                <Input
                  type="text"
                  value={editFormData.name}
                  onChange={(e) => setEditFormData({...editFormData, name: e.target.value})}
                  required
                  placeholder="Ej: admin, tecnico"
                />
                <small className="text-muted">Nombre técnico del rol (sin espacios, en minúsculas)</small>
              </FormGroup>
              
              <FormGroup>
                <Label>Nombre para Mostrar *</Label>
                <Input
                  type="text"
                  value={editFormData.display_name}
                  onChange={(e) => setEditFormData({...editFormData, display_name: e.target.value})}
                  required
                  placeholder="Ej: Administrador, Técnico"
                />
                <small className="text-muted">Nombre que se mostrará en la interfaz</small>
              </FormGroup>
              
              <FormGroup>
                <Label>Descripción</Label>
                <Input
                  type="textarea"
                  value={editFormData.description}
                  onChange={(e) => setEditFormData({...editFormData, description: e.target.value})}
                  rows="3"
                  placeholder="Descripción del rol y sus responsabilidades"
                />
              </FormGroup>
              
              <div className="text-right">
                <Button color="secondary" className="mr-2" onClick={() => setEditModal(false)}>
                  Cancelar
                </Button>
                <Button color="primary" type="submit">
                  Actualizar Rol
                </Button>
              </div>
            </Form>
          </ModalBody>
        </Modal>
      </Container>
    </>
  );
};

export default RoleManagement;
