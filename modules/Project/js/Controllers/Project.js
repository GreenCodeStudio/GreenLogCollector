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
        const container = page.querySelector('.page-Project-list .container');
        let datasource = new DatasourceAjax('Project', 'getTable', ['Project', 'Project'], null, 'updateMultiple');
        let objectsList = new ObjectsList(datasource);
        objectsList.allowTableEdit = true;
        objectsList.columns = [];
                objectsList.columns.push({
            name: t('Project.name'),
            dataName: 'name',
            sortName: 'name',
            width: 100,
            widthGrow: 1
        });
        objectsList.generateActions = (rows, mode) => {
            let ret = [];
            if (rows.length == 1) {
                if (Permissions.can('Project', 'edit')) {
                    ret.push({
                        name: TCommonBase("edit"),
                        icon: 'icon-edit',
                        href: "/Project/edit/" + rows[0].id,
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
        form.load(data.Project);

        form.submit = async newData => {
            await Ajax.Project.update(newData);
            pageManager.goto('/Project');
        }
    }
}
export class add {
    constructor(page, data) {
        let form = new FormManager(page.querySelector('form'));
        if(data && data.selects)
            form.loadSelects(data.selects);

        form.submit = async newData => {
            await Ajax.Project.insert(newData);
            pageManager.goto('/Project');
        }
    }
}