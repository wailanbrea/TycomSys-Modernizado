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
import { Link } from "react-router-dom";
// reactstrap components
import {
  DropdownMenu,
  DropdownItem,
  UncontrolledDropdown,
  DropdownToggle,
  Form,
  FormGroup,
  InputGroupAddon,
  InputGroupText,
  Input,
  InputGroup,
  Navbar,
  Nav,
  Container,
  Media,
} from "reactstrap";

const AdminNavbar = (props) => {
  return (
    <>
      <Navbar className="navbar-top navbar-dark" expand="md" id="navbar-main">
        <Container fluid>
          <Form className="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
            <FormGroup className="mb-0">
              <InputGroup className="input-group-alternative">
                <InputGroupAddon addonType="prepend">
                  <InputGroupText>
                    <i className="fas fa-search" />
                  </InputGroupText>
                </InputGroupAddon>
                <Input placeholder="Search" type="text" />
              </InputGroup>
            </FormGroup>
          </Form>
          <Nav className="align-items-center d-none d-md-flex" navbar>
            <UncontrolledDropdown nav>
              <DropdownToggle className="pr-0" nav>
                <Media className="align-items-center">
                  <span className="avatar avatar-sm rounded-circle">
                    <img
                      alt="..."
                      src={require("../../assets/img/theme/team-4-800x800.jpg")}
                    />
                  </span>
                  <Media className="ml-2 d-none d-lg-block">
                    <span className="mb-0 text-sm font-weight-bold">
                      {window.user ? window.user.name : 'Usuario'}
                    </span>
                    <br />
                    <span className="text-muted text-xs">
                      {window.user?.roles?.[0]?.display_name || 'Sin rol'}
                    </span>
                  </Media>
                </Media>
              </DropdownToggle>
              <DropdownMenu className="dropdown-menu-arrow" right>
                <DropdownItem className="noti-title" header tag="div">
                  <h6 className="text-overflow m-0">
                    ¡Bienvenido{window.user ? `, ${window.user.name}` : ''}!
                  </h6>
                  {window.user && (
                    <small className="text-muted">
                      {window.user.email}
                    </small>
                  )}
                </DropdownItem>
                <DropdownItem to="/admin/user-profile" tag={Link}>
                  <i className="ni ni-single-02" />
                  <span>Mi Perfil</span>
                </DropdownItem>
                <DropdownItem to="/admin/user-profile" tag={Link}>
                  <i className="ni ni-settings-gear-65" />
                  <span>Configuración</span>
                </DropdownItem>
                <DropdownItem to="/admin/user-profile" tag={Link}>
                  <i className="ni ni-calendar-grid-58" />
                  <span>Actividad</span>
                </DropdownItem>
                <DropdownItem to="/admin/user-profile" tag={Link}>
                  <i className="ni ni-support-16" />
                  <span>Soporte</span>
                </DropdownItem>
                {window.user?.is_admin && (
                  <>
                    <DropdownItem divider />
                    <DropdownItem to="/admin/user-management" tag={Link}>
                      <i className="ni ni-single-02" />
                      <span>Gestión de Usuarios</span>
                    </DropdownItem>
                    <DropdownItem to="/admin/role-management" tag={Link}>
                      <i className="ni ni-badge" />
                      <span>Gestión de Roles</span>
                    </DropdownItem>
                  </>
                )}
                <DropdownItem divider />
                <DropdownItem href="#" onClick={(e) => {
                  e.preventDefault();
                  // Crear formulario para logout
                  const form = document.createElement('form');
                  form.method = 'POST';
                  form.action = '/logout';
                  
                  // Agregar token CSRF
                  const csrfToken = document.querySelector('meta[name="csrf-token"]');
                  if (csrfToken) {
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken.getAttribute('content');
                    form.appendChild(csrfInput);
                  }
                  
                  document.body.appendChild(form);
                  form.submit();
                }}>
                  <i className="ni ni-user-run" />
                  <span>Cerrar Sesión</span>
                </DropdownItem>
              </DropdownMenu>
            </UncontrolledDropdown>
          </Nav>
        </Container>
      </Navbar>
    </>
  );
};

export default AdminNavbar;
