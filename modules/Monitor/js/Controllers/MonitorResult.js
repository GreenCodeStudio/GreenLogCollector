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
        const container = page.querySelector('.page-MonitorResult-list .container');
        let datasource = new DatasourceAjax('MonitorResult', 'getTable', ['Monitor', 'MonitorResult'], null, 'updateMultiple');
        let objectsList = new ObjectsList(datasource);
        objectsList.allowTableEdit = true;
        objectsList.columns = [];
                objectsList.columns.push({
            name: t('MonitorResult.monitor_id'),
            dataName: 'monitor_id',
            sortName: 'monitor_id',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('MonitorResult.stamp'),
            dataName: 'stamp',
            sortName: 'stamp',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('MonitorResult.responseTime'),
            dataName: 'responseTime',
            sortName: 'responseTime',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('MonitorResult.isSuccess'),
            dataName: 'isSuccess',
            sortName: 'isSuccess',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('MonitorResult.status'),
            dataName: 'status',
            sortName: 'status',
            width: 100,
            widthGrow: 1
        });
        objectsList.generateActions = (rows, mode) => {
            let ret = [];
            if (rows.length == 1) {
                if (Permissions.can('MonitorResult', 'edit')) {
                    ret.push({
                        name: TCommonBase("edit"),
                        icon: 'icon-edit',
                        href: "/MonitorResult/edit/" + rows[0].id,
                        action:"edit"
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
        form.load(data.MonitorResult);

        form.submit = async newData => {
            await Ajax.MonitorResult.update(newData);
            pageManager.goto('/MonitorResult');
        }
    }
}
export class add {
    constructor(page, data) {
        let form = new FormManager(page.querySelector('form'));
        if(data && data.selects)
            form.loadSelects(data.selects);

        form.submit = async newData => {
            await Ajax.MonitorResult.insert(newData);
            pageManager.goto('/MonitorResult');
        }
    }
}
