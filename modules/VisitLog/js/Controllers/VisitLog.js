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
        const container = page.querySelector('.page-VisitLog-list .container');
        let datasource = new DatasourceAjax('VisitLog', 'getTable', ['VisitLog', 'VisitLog'], null, 'updateMultiple');
        let objectsList = new ObjectsList(datasource);
        objectsList.allowTableEdit = true;
        objectsList.columns = [];
                objectsList.columns.push({
            name: t('VisitLog.project_id'),
            dataName: 'project_id',
            sortName: 'project_id',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('VisitLog.userIdentifier'),
            dataName: 'userIdentifier',
            sortName: 'userIdentifier',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('VisitLog.userAgent'),
            dataName: 'userAgent',
            sortName: 'userAgent',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('VisitLog.ipAddress'),
            dataName: 'ipAddress',
            sortName: 'ipAddress',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('VisitLog.sessionIdentifier'),
            dataName: 'sessionIdentifier',
            sortName: 'sessionIdentifier',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('VisitLog.pageOpenIdentifier'),
            dataName: 'pageOpenIdentifier',
            sortName: 'pageOpenIdentifier',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('VisitLog.url'),
            dataName: 'url',
            sortName: 'url',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('VisitLog.added'),
            dataName: 'added',
            sortName: 'added',
            width: 100,
            widthGrow: 1
        });        objectsList.columns.push({
            name: t('VisitLog.type'),
            dataName: 'type',
            sortName: 'type',
            width: 100,
            widthGrow: 1
        });
        objectsList.generateActions = (rows, mode) => {
            let ret = [];
            if (rows.length == 1) {
                if (Permissions.can('VisitLog', 'edit')) {
                    ret.push({
                        name: TCommonBase("edit"),
                        icon: 'icon-edit',
                        href: "/VisitLog/edit/" + rows[0].id,
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
        form.load(data.VisitLog);

        form.submit = async newData => {
            await Ajax.VisitLog.update(newData);
            pageManager.goto('/VisitLog');
        }
    }
}
export class add {
    constructor(page, data) {
        let form = new FormManager(page.querySelector('form'));
        if(data && data.selects)
            form.loadSelects(data.selects);

        form.submit = async newData => {
            await Ajax.VisitLog.insert(newData);
            pageManager.goto('/VisitLog');
        }
    }
}