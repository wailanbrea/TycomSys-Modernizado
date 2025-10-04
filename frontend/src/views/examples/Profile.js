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
  Button,
  Card,
  CardHeader,
  CardBody,
  FormGroup,
  Form,
  Input,
  Container,
  Row,
  Col,
  Badge,
  Alert,
} from "reactstrap";
// core components
import UserHeader from "components/Headers/UserHeader.js";
import { useState, useEffect } from "react";

const Profile = () => {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    address: '',
    city: '',
    country: '',
    postal_code: '',
    about: ''
  });

  useEffect(() => {
    // Obtener datos del usuario desde window.user
    if (window.user) {
      setUser(window.user);
      setFormData({
        name: window.user.name || '',
        email: window.user.email || '',
        address: '',
        city: '',
        country: '',
        postal_code: '',
        about: `Usuario del sistema TICOMSYS con rol ${window.user.roles?.[0]?.display_name || 'Sin rol'}`
      });
    }
    setLoading(false);
  }, []);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Aquí se implementaría la actualización del perfil
    alert('Perfil actualizado correctamente');
  };

  if (loading) {
    return (
      <Container className="mt--7" fluid>
        <Row>
          <Col>
            <Alert color="info">Cargando perfil...</Alert>
          </Col>
        </Row>
      </Container>
    );
  }

  if (!user) {
    return (
      <Container className="mt--7" fluid>
        <Row>
          <Col>
            <Alert color="danger">No se pudo cargar la información del usuario</Alert>
          </Col>
        </Row>
      </Container>
    );
  }
  return (
    <>
      <UserHeader />
      {/* Page content */}
      <Container className="mt--7" fluid>
        <Row>
          <Col className="order-xl-2 mb-5 mb-xl-0" xl="4">
            <Card className="card-profile shadow">
              <Row className="justify-content-center">
                <Col className="order-lg-2" lg="3">
                  <div className="card-profile-image">
                    <a href="#pablo" onClick={(e) => e.preventDefault()}>
                      <img
                        alt="..."
                        className="rounded-circle"
                        src={require("../../assets/img/theme/team-4-800x800.jpg")}
                      />
                    </a>
                  </div>
                </Col>
              </Row>
              <CardHeader className="text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <div className="d-flex justify-content-between">
                  <Button
                    className="mr-4"
                    color="info"
                    href="#pablo"
                    onClick={(e) => e.preventDefault()}
                    size="sm"
                  >
                    Connect
                  </Button>
                  <Button
                    className="float-right"
                    color="default"
                    href="#pablo"
                    onClick={(e) => e.preventDefault()}
                    size="sm"
                  >
                    Message
                  </Button>
                </div>
              </CardHeader>
              <CardBody className="pt-0 pt-md-4">
                <Row>
                  <div className="col">
                    <div className="card-profile-stats d-flex justify-content-center mt-md-5">
                      <div>
                        <span className="heading">22</span>
                        <span className="description">Friends</span>
                      </div>
                      <div>
                        <span className="heading">10</span>
                        <span className="description">Photos</span>
                      </div>
                      <div>
                        <span className="heading">89</span>
                        <span className="description">Comments</span>
                      </div>
                    </div>
                  </div>
                </Row>
                <div className="text-center">
                  <h3>
                    {user.name}
                    <span className="font-weight-light">, ID: {user.id}</span>
                  </h3>
                  <div className="h5 font-weight-300">
                    <i className="ni ni-email-83 mr-2" />
                    {user.email}
                  </div>
                  <div className="h5 mt-4">
                    <i className="ni ni-badge mr-2" />
                    {user.roles?.map(role => (
                      <Badge key={role.id} color="primary" className="mr-1">
                        {role.display_name}
                      </Badge>
                    ))}
                  </div>
                  <div>
                    <i className="ni ni-key-25 mr-2" />
                    {user.permissions?.length || 0} permisos asignados
                  </div>
                  <hr className="my-4" />
                  <p>
                    Usuario del sistema TICOMSYS con acceso completo a las funcionalidades 
                    según su rol y permisos asignados.
                  </p>
                  <div className="mt-3">
                    <Badge color="success" className="mr-1">
                      {user.is_admin ? 'Administrador' : ''}
                    </Badge>
                    <Badge color="info" className="mr-1">
                      {user.is_tecnico ? 'Técnico' : ''}
                    </Badge>
                  </div>
                </div>
              </CardBody>
            </Card>
          </Col>
          <Col className="order-xl-1" xl="8">
            <Card className="bg-secondary shadow">
              <CardHeader className="bg-white border-0">
                <Row className="align-items-center">
                  <Col xs="8">
                    <h3 className="mb-0">My account</h3>
                  </Col>
                  <Col className="text-right" xs="4">
                    <Button
                      color="primary"
                      href="#pablo"
                      onClick={(e) => e.preventDefault()}
                      size="sm"
                    >
                      Settings
                    </Button>
                  </Col>
                </Row>
              </CardHeader>
              <CardBody>
                <Form onSubmit={handleSubmit}>
                  <h6 className="heading-small text-muted mb-4">
                    Información del Usuario
                  </h6>
                  <div className="pl-lg-4">
                    <Row>
                      <Col lg="6">
                        <FormGroup>
                          <label
                            className="form-control-label"
                            htmlFor="input-name"
                          >
                            Nombre Completo
                          </label>
                          <Input
                            className="form-control-alternative"
                            value={formData.name}
                            onChange={handleInputChange}
                            name="name"
                            id="input-name"
                            placeholder="Nombre completo"
                            type="text"
                          />
                        </FormGroup>
                      </Col>
                      <Col lg="6">
                        <FormGroup>
                          <label
                            className="form-control-label"
                            htmlFor="input-email"
                          >
                            Correo Electrónico
                          </label>
                          <Input
                            className="form-control-alternative"
                            value={formData.email}
                            onChange={handleInputChange}
                            name="email"
                            id="input-email"
                            placeholder="correo@ejemplo.com"
                            type="email"
                          />
                        </FormGroup>
                      </Col>
                    </Row>
                    <Row>
                      <Col lg="12">
                        <FormGroup>
                          <label
                            className="form-control-label"
                            htmlFor="input-roles"
                          >
                            Roles Asignados
                          </label>
                          <div className="form-control-alternative" style={{padding: '10px'}}>
                            {user.roles?.map(role => (
                              <Badge key={role.id} color="primary" className="mr-2 mb-1">
                                {role.display_name}
                              </Badge>
                            ))}
                          </div>
                        </FormGroup>
                      </Col>
                    </Row>
                  </div>
                  <hr className="my-4" />
                  {/* Address */}
                  <h6 className="heading-small text-muted mb-4">
                    Contact information
                  </h6>
                  <div className="pl-lg-4">
                    <Row>
                      <Col md="12">
                        <FormGroup>
                          <label
                            className="form-control-label"
                            htmlFor="input-address"
                          >
                            Address
                          </label>
                          <Input
                            className="form-control-alternative"
                            defaultValue="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09"
                            id="input-address"
                            placeholder="Home Address"
                            type="text"
                          />
                        </FormGroup>
                      </Col>
                    </Row>
                    <Row>
                      <Col lg="4">
                        <FormGroup>
                          <label
                            className="form-control-label"
                            htmlFor="input-city"
                          >
                            City
                          </label>
                          <Input
                            className="form-control-alternative"
                            defaultValue="New York"
                            id="input-city"
                            placeholder="City"
                            type="text"
                          />
                        </FormGroup>
                      </Col>
                      <Col lg="4">
                        <FormGroup>
                          <label
                            className="form-control-label"
                            htmlFor="input-country"
                          >
                            Country
                          </label>
                          <Input
                            className="form-control-alternative"
                            defaultValue="United States"
                            id="input-country"
                            placeholder="Country"
                            type="text"
                          />
                        </FormGroup>
                      </Col>
                      <Col lg="4">
                        <FormGroup>
                          <label
                            className="form-control-label"
                            htmlFor="input-country"
                          >
                            Postal code
                          </label>
                          <Input
                            className="form-control-alternative"
                            id="input-postal-code"
                            placeholder="Postal code"
                            type="number"
                          />
                        </FormGroup>
                      </Col>
                    </Row>
                  </div>
                  <hr className="my-4" />
                  {/* Permissions */}
                  <h6 className="heading-small text-muted mb-4">Permisos del Usuario</h6>
                  <div className="pl-lg-4">
                    <FormGroup>
                      <label>Permisos Asignados</label>
                      <div className="form-control-alternative" style={{padding: '10px', minHeight: '100px'}}>
                        {user.permissions?.map(permission => (
                          <Badge key={permission.id} color="success" className="mr-2 mb-1">
                            {permission.display_name}
                          </Badge>
                        ))}
                      </div>
                    </FormGroup>
                  </div>
                  <hr className="my-4" />
                  {/* Description */}
                  <h6 className="heading-small text-muted mb-4">Acerca de mí</h6>
                  <div className="pl-lg-4">
                    <FormGroup>
                      <label>Descripción</label>
                      <Input
                        className="form-control-alternative"
                        placeholder="Algunas palabras sobre ti..."
                        rows="4"
                        value={formData.about}
                        onChange={handleInputChange}
                        name="about"
                        type="textarea"
                      />
                    </FormGroup>
                  </div>
                  <div className="text-center">
                    <Button color="primary" type="submit">
                      Guardar Cambios
                    </Button>
                  </div>
                </Form>
              </CardBody>
            </Card>
          </Col>
        </Row>
      </Container>
    </>
  );
};

export default Profile;
