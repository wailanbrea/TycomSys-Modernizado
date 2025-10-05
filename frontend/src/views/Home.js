/*!
=========================================================
* TICOMSYS - Página Principal
=========================================================
* Página principal con hero y información de la empresa
=========================================================
*/

import React from "react";
import { Container, Row, Col } from "reactstrap";

const Home = () => {
  return (
    <>
      {/* Hero Section */}
      <div className="hero-section bg-gradient-primary">
        <Container>
          <Row className="align-items-center min-vh-100">
            <Col lg="6">
              <div className="text-white">
                <h1 className="display-3 font-weight-bold mb-4">
                  TicomSys
                </h1>
                <h2 className="h3 mb-4">
                  Soluciones Informáticas a su Servicio
                </h2>
                <p className="lead mb-4">
                  Ofrecemos soluciones informáticas completas, digitalización masiva de documentos 
                  con Suite AQuarius, y servicios de reparación de equipos en República Dominicana.
                </p>
                <div className="d-flex flex-wrap gap-3">
                  <a 
                    href="/consulta" 
                    className="btn btn-white btn-lg px-4 py-3 rounded-pill"
                  >
                    Consultar Estado
                  </a>
                  <a 
                    href="/ticomsyslogin" 
                    className="btn btn-outline-white btn-lg px-4 py-3 rounded-pill"
                  >
                    Acceso Empleados
                  </a>
                </div>
              </div>
            </Col>
            <Col lg="6">
              <div className="text-center">
                <img 
                  src="/images/logoticomsys.png" 
                  alt="TicomSys Logo" 
                  className="img-fluid"
                  style={{ maxHeight: '400px' }}
                />
              </div>
            </Col>
          </Row>
        </Container>
      </div>

      {/* Services Section */}
      <section className="py-5">
        <Container>
          <Row className="text-center mb-5">
            <Col>
              <h2 className="h1 mb-4">Nuestros Servicios</h2>
              <p className="lead text-muted">
                Soluciones integrales para todas sus necesidades informáticas
              </p>
            </Col>
          </Row>
          <Row>
            <Col md="4" className="mb-4">
              <div className="card h-100 border-0 shadow-sm">
                <div className="card-body text-center p-4">
                  <div className="icon icon-shape icon-shape-primary rounded-circle mb-3">
                    <i className="ni ni-laptop text-white"></i>
                  </div>
                  <h4 className="h5">Reparación de Equipos</h4>
                  <p className="text-muted">
                    Servicio técnico especializado para laptops, desktops, smartphones y más.
                  </p>
                </div>
              </div>
            </Col>
            <Col md="4" className="mb-4">
              <div className="card h-100 border-0 shadow-sm">
                <div className="card-body text-center p-4">
                  <div className="icon icon-shape icon-shape-success rounded-circle mb-3">
                    <i className="ni ni-archive-2 text-white"></i>
                  </div>
                  <h4 className="h5">Digitalización de Documentos</h4>
                  <p className="text-muted">
                    Suite AQuarius para digitalización masiva y gestión documental.
                  </p>
                </div>
              </div>
            </Col>
            <Col md="4" className="mb-4">
              <div className="card h-100 border-0 shadow-sm">
                <div className="card-body text-center p-4">
                  <div className="icon icon-shape icon-shape-info rounded-circle mb-3">
                    <i className="ni ni-settings-gear-65 text-white"></i>
                  </div>
                  <h4 className="h5">Soluciones Informáticas</h4>
                  <p className="text-muted">
                    Consultoría y desarrollo de soluciones tecnológicas personalizadas.
                  </p>
                </div>
              </div>
            </Col>
          </Row>
        </Container>
      </section>

      {/* Contact Section */}
      <section className="py-5 bg-light">
        <Container>
          <Row className="align-items-center">
            <Col lg="6">
              <h2 className="h1 mb-4">¿Necesita Ayuda?</h2>
              <p className="lead text-muted mb-4">
                Nuestro equipo de técnicos especializados está listo para atender sus necesidades.
              </p>
              <div className="d-flex align-items-center mb-3">
                <i className="ni ni-mobile-button text-primary mr-3"></i>
                <span>+1 (809) 555-0123</span>
              </div>
              <div className="d-flex align-items-center mb-3">
                <i className="ni ni-email-83 text-primary mr-3"></i>
                <span>info@ticomsys.com</span>
              </div>
              <div className="d-flex align-items-center">
                <i className="ni ni-pin-3 text-primary mr-3"></i>
                <span>Santo Domingo, República Dominicana</span>
              </div>
            </Col>
            <Col lg="6">
              <div className="text-center">
                <img 
                  src="/images/verne-ho-0LAJfSNa-xQ-unsplash.jpg" 
                  alt="Técnicos trabajando" 
                  className="img-fluid rounded shadow"
                />
              </div>
            </Col>
          </Row>
        </Container>
      </section>
    </>
  );
};

export default Home;
