/*!
=========================================================
* TICOMSYS - Page Header Component
=========================================================
* Header reutilizable para todas las páginas del sistema
=========================================================
*/

import React from "react";
import { Container, Row, Col } from "reactstrap";

const PageHeader = ({ title, subtitle, icon }) => {
  return (
    <div className="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <Container fluid>
        <div className="header-body">
          <Row>
            <div className="col">
              <div className="d-flex align-items-center">
                {icon && (
                  <div className="mr-3">
                    <div className="icon icon-shape bg-white text-primary rounded-circle shadow">
                      <i className={icon} />
                    </div>
                  </div>
                )}
                <div>
                  <h1 className="display-2 text-white">{title}</h1>
                  {subtitle && (
                    <p className="text-white mt-0 mb-5">{subtitle}</p>
                  )}
                </div>
              </div>
            </div>
          </Row>
        </div>
      </Container>
    </div>
  );
};

export default PageHeader;

