import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {RouterModule, Routes} from "@angular/router";
import {VisiteComponent} from "./visite.component";

const routes: Routes = [
    {
        path: '',
        component: VisiteComponent
    }
];

@NgModule({
    declarations: [],
    imports: [CommonModule, RouterModule.forChild(routes)],
    exports: [RouterModule]
})
export class VisiteRoutingModule {
}
