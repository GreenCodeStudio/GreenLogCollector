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
        const container = page.querySelector('.page-ExtraLog-list .container');
        let datasource = new DatasourceAjax('ExtraLog', 'getTable', ['ExtraLog', 'ExtraLog'], null, 'updateMultiple');
        let objectsList = new ObjectsList(datasource);
        objectsList.allowTableEdit = true;
        objectsList.columns = [];
                objectsList.columns.push({
            name: t('ExtraLog.project_id'),
            dataName: 'project_id',
            sortName: 'project_id',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('ExtraLog.pageOpenIdentifier'),
            dataName: 'pageOpenIdentifier',
            sortName: 'pageOpenIdentifier',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('ExtraLog.added'),
            dataName: 'added',
            sortName: 'added',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('ExtraLog.source'),
            dataName: 'source',
            sortName: 'source',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('ExtraLog.type'),
            dataName: 'type',
            sortName: 'type',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('ExtraLog.data'),
            dataName: 'data',
            sortName: 'data',
            width: 100,
            widthGrow: 1
        });
        objectsList.generateActions = (rows, mode) => {
            let ret = [];
            if (rows.length == 1) {
                if (Permissions.can('ExtraLog', 'edit')) {
                    ret.push({
                        name: TCommonBase("edit"),
                        icon: 'icon-edit',
                        href: "/ExtraLog/edit/" + rows[0].id,
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
        form.load(data.ExtraLog);

        form.submit = async newData => {
            await Ajax.ExtraLog.update(newData);
            pageManager.goto('/ExtraLog');
        }
    }
}
export class add {
    constructor(page, data) {
        let form = new FormManager(page.querySelector('form'));
        if(data && data.selects)
            form.loadSelects(data.selects);

        form.submit = async newData => {
            await Ajax.ExtraLog.insert(newData);
            pageManager.goto('/ExtraLog');
        }
    }
}