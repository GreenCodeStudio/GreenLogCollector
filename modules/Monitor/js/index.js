import {pageManager} from "../../Core/js/pageManager";
pageManager.registerController('Monitor', () => import('./Controllers/Monitor'));
pageManager.registerController('MonitorResult', () => import('./Controllers/MonitorResult'));