import {FormManager} from "../../../Core/js/form";
import {Ajax} from "../../../Core/js/ajax";
import {pageManager} from "../../../Core/js/pageManager";
import {DatasourceAjax} from "../../../Core/js/datasourceAjax";
import {t} from "../../i18n.xml";
import {t as TCommonBase} from "../../../CommonBase/i18n.xml";
import {ObjectsList} from "../../../Core/js/ObjectsList/objectsList";
import {Permissions} from "../../../Core/js/permissions";

export class index {
    constructor(page, data) {
        const container = page.querySelector('.page-Monitor-list .container');
        let datasource = new DatasourceAjax('Monitor', 'getTable', ['Monitor', 'Monitor'], null, 'updateMultiple');
        let objectsList = new ObjectsList(datasource);
        objectsList.allowTableEdit = true;
        objectsList.columns = [];
        objectsList.columns.push({
            name: t('Monitor.name'),
            dataName: 'name',
            sortName: 'name',
            width: 100,
            widthGrow: 1
        });
        objectsList.columns.push({
            name: t('Monitor.address'),
            dataName: 'address',
            sortName: 'address',
            width: 100,
            widthGrow: 1
        });
        objectsList.columns.push({
            name: t('Monitor.type'),
            dataName: 'type',
            sortName: 'type',
            width: 100,
            widthGrow: 1
        });
        objectsList.columns.push({
            name: t('Monitor.project_id'),
            dataName: 'project_id',
            sortName: 'project_id',
            width: 100,
            widthGrow: 1
        });
        objectsList.generateActions = (rows, mode) => {
            let ret = [];
            if (rows.length == 1) {
                if (Permissions.can('Monitor', 'show')) {
                    ret.push({
                        name: TCommonBase("show"),
                        icon: 'icon-show',
                        href: "/Monitor/show/" + rows[0].id,
                        action: "show"
                    });
                }
            }
            if (rows.length == 1) {
                if (Permissions.can('Monitor', 'edit')) {
                    ret.push({
                        name: TCommonBase("edit"),
                        icon: 'icon-edit',
                        href: "/Monitor/edit/" + rows[0].id,
                        action: "edit"
                    });
                }
            }
            return ret;
        }
        container.append(objectsList);
        objectsList.refresh();
    }
}

export class edit {
    constructor(page, data) {
        let form = new FormManager(page.querySelector('form'));
        form.loadSelects(data.selects);
        form.load(data.Monitor);

        form.submit = async newData => {
            await Ajax.Monitor.update(newData);
            pageManager.goto('/Monitor');
        }
    }
}

export class add {
    constructor(page, data) {
        let form = new FormManager(page.querySelector('form'));
        if (data && data.selects)
            form.loadSelects(data.selects);

        form.submit = async newData => {
            await Ajax.Monitor.insert(newData);
            pageManager.goto('/Monitor');
        }
    }
}
