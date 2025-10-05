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
import Index from "views/Index.js";
import Home from "views/Home.js";
import Profile from "views/examples/Profile.js";
import UserManagement from "views/examples/UserManagement.js";
import RoleManagement from "views/examples/RoleManagement.js";
import RepairEquipmentManagement from "views/examples/RepairEquipmentManagement.js";
import TicketManagement from "views/examples/TicketManagement.js";
import InvoiceManagement from "views/examples/InvoiceManagement.js";
import InvoiceView from "views/examples/InvoiceView.js";
import Reports from "views/examples/Reports.js";
import ReportsAdvanced from "views/examples/ReportsAdvanced.js";

var routes = [
  {
    path: "home",
    name: "Página Principal",
    icon: "ni ni-shop text-primary",
    component: <Home />,
    layout: "/admin",
    roles: ["admin", "tecnico"]
  },
  {
    path: "index",
    name: "Dashboard",
    icon: "ni ni-tv-2 text-primary",
    component: <Index />,
    layout: "/admin",
    roles: ["admin", "tecnico"]
  },
  {
    path: "user-management",
    name: "Gestión de Usuarios",
    icon: "ni ni-single-02 text-yellow",
    component: <UserManagement />,
    layout: "/admin",
    roles: ["admin"],
    permissions: ["manage_users"]
  },
  {
    path: "role-management",
    name: "Gestión de Roles",
    icon: "ni ni-badge text-purple",
    component: <RoleManagement />,
    layout: "/admin",
    roles: ["admin"],
    permissions: ["manage_roles"]
  },
  {
    path: "repair-equipment",
    name: "Equipos de Reparación",
    icon: "ni ni-settings-gear-65 text-info",
    component: <RepairEquipmentManagement />,
    layout: "/admin",
    roles: ["admin", "tecnico"],
    permissions: ["manage_equipment"]
  },
  {
    path: "tickets",
    name: "Estados de Tickets",
    icon: "ni ni-single-copy-04 text-orange",
    component: <TicketManagement />,
    layout: "/admin",
    roles: ["admin", "tecnico"],
    permissions: ["manage_tickets", "view_tickets"]
  },
  {
    path: "invoices",
    name: "Gestión de Facturas",
    icon: "ni ni-money-coins text-green",
    component: <InvoiceManagement />,
    layout: "/admin",
    roles: ["admin", "tecnico"],
    permissions: ["manage_invoices"]
  },
  {
    path: "invoice-view",
    name: "Facturas Registradas",
    icon: "ni ni-single-copy-04 text-blue",
    component: <InvoiceView />,
    layout: "/admin",
    roles: ["admin", "tecnico"],
    permissions: ["view_invoices"]
  },
  {
    path: "reports",
    name: "Reportes",
    icon: "ni ni-chart-bar-32 text-blue",
    component: <Reports />,
    layout: "/admin",
    roles: ["admin", "tecnico"],
    permissions: ["view_reports"]
  },
  {
    path: "reports-advanced",
    name: "Reportes Avanzados",
    icon: "ni ni-chart-pie-35 text-success",
    component: <ReportsAdvanced />,
    layout: "/admin",
    roles: ["admin", "tecnico"],
    permissions: ["view_reports"]
  },
  {
    path: "user-profile",
    name: "Mi Perfil",
    icon: "ni ni-single-02 text-yellow",
    component: <Profile />,
    layout: "/admin",
    roles: ["admin", "tecnico"]
  }
];

export default routes;
