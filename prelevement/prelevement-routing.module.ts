import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {RouterModule, Routes} from "@angular/router";
import {PrelevementComponent} from "./prelevement.component";
import {TestComponent} from "../test/test.component";
const routes: Routes = [
    {
        path: '',
        component:PrelevementComponent
    },
    {
        path: 'test/:id',
        component: TestComponent
    }
];

@NgModule({
    declarations: [],
    imports: [CommonModule, RouterModule.forChild(routes)],
    exports: [RouterModule]
})
export class PrelevementRoutingModule {
}
