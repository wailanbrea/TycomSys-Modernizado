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
  UncontrolledTooltip,
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

const UserManagement = () => {
  const [users, setUsers] = useState([]);
  const [roles, setRoles] = useState([]);
  const [loading, setLoading] = useState(true);
  const [modal, setModal] = useState(false);
  const [selectedUser, setSelectedUser] = useState(null);
  const [selectedRole, setSelectedRole] = useState('');

  useEffect(() => {
    loadUsers();
    loadRoles();
  }, []);

  const loadUsers = async () => {
    try {
      const response = await fetch('/api/users');
      if (response.ok) {
        const data = await response.json();
        setUsers(data);
      }
    } catch (error) {
      console.error('Error loading users:', error);
    }
    setLoading(false);
  };

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
  };

  const handleAssignRole = async () => {
    if (!selectedUser || !selectedRole) return;

    try {
      const response = await fetch(`/api/users/${selectedUser.id}/assign-role`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ role_id: selectedRole }),
      });

      if (response.ok) {
        loadUsers(); // Recargar usuarios
        setModal(false);
        setSelectedUser(null);
        setSelectedRole('');
      }
    } catch (error) {
      console.error('Error assigning role:', error);
    }
  };

  const handleRemoveRole = async (user, role) => {
    try {
      const response = await fetch(`/api/users/${user.id}/remove-role/${role.id}`, {
        method: 'DELETE',
      });

      if (response.ok) {
        loadUsers(); // Recargar usuarios
      }
    } catch (error) {
      console.error('Error removing role:', error);
    }
  };

  const openModal = (user) => {
    setSelectedUser(user);
    setModal(true);
  };

  if (loading) {
    return (
      <Container className="mt--7" fluid>
        <Row>
          <Col>
            <Alert color="info">Cargando usuarios...</Alert>
          </Col>
        </Row>
      </Container>
    );
  }

  return (
    <>
      <PageHeader 
        title="Gestión de Usuarios" 
        subtitle="Administra los usuarios del sistema y sus roles"
        icon="fas fa-users"
      />
      
      {/* Page content */}
      <Container className="mt--7" fluid>
        {/* Table */}
        <Row>
          <div className="col">
            <Card className="shadow">
              <CardHeader className="border-0">
                <Row className="align-items-center">
                  <Col>
                    <h3 className="mb-0">Gestión de Usuarios</h3>
                  </Col>
                  <Col className="text-right">
                    <Button color="primary" size="sm">
                      <i className="ni ni-fat-add mr-1" />
                      Nuevo Usuario
                    </Button>
                  </Col>
                </Row>
              </CardHeader>
              <Table className="align-items-center table-flush" responsive>
                <thead className="thead-light">
                  <tr>
                    <th scope="col">Usuario</th>
                    <th scope="col">Email</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                    <th scope="col" />
                  </tr>
                </thead>
                <tbody>
                  {users.map((user) => (
                    <tr key={user.id}>
                      <th scope="row">
                        <Media className="align-items-center">
                          <a
                            className="avatar rounded-circle mr-3"
                            href="#pablo"
                            onClick={(e) => e.preventDefault()}
                          >
                            <img
                              alt="..."
                              src={require("../../assets/img/theme/team-1-800x800.jpg")}
                            />
                          </a>
                          <Media>
                            <span className="mb-0 text-sm">
                              {user.name}
                            </span>
                          </Media>
                        </Media>
                      </th>
                      <td>{user.email}</td>
                      <td>
                        <div className="d-flex flex-wrap">
                          {user.roles?.map((role) => (
                            <Badge key={role.id} color="primary" className="mr-1 mb-1">
                              {role.display_name}
                            </Badge>
                          ))}
                        </div>
                      </td>
                      <td>
                        <Badge color="" className="badge-dot mr-4">
                          <i className="bg-success" />
                          Activo
                        </Badge>
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
                                openModal(user);
                              }}
                            >
                              <i className="ni ni-badge mr-2" />
                              Asignar Rol
                            </DropdownItem>
                            <DropdownItem
                              href="#pablo"
                              onClick={(e) => e.preventDefault()}
                            >
                              <i className="ni ni-settings-gear-65 mr-2" />
                              Editar
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

        {/* Modal para asignar rol */}
        <Modal isOpen={modal} toggle={() => setModal(false)}>
          <ModalHeader toggle={() => setModal(false)}>
            Asignar Rol a {selectedUser?.name}
          </ModalHeader>
          <ModalBody>
            <Form>
              <FormGroup>
                <Label for="roleSelect">Seleccionar Rol</Label>
                <Input
                  type="select"
                  name="role"
                  id="roleSelect"
                  value={selectedRole}
                  onChange={(e) => setSelectedRole(e.target.value)}
                >
                  <option value="">Seleccionar rol...</option>
                  {roles.map((role) => (
                    <option key={role.id} value={role.id}>
                      {role.display_name} - {role.description}
                    </option>
                  ))}
                </Input>
              </FormGroup>
            </Form>
          </ModalBody>
          <ModalFooter>
            <Button color="primary" onClick={handleAssignRole}>
              Asignar Rol
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

export default UserManagement;
