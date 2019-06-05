import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {RouterModule, Routes} from "@angular/router";
import {DonneurComponent} from "./donneur.component";
import {PrelevementComponent} from "../prelevement/prelevement.component";
const routes: Routes = [
    {
        path: '',
        component: DonneurComponent
    },
    {
        path: 'prelevement/:id',
        component: PrelevementComponent
    }
];

@NgModule({
    declarations: [],
    imports: [CommonModule, RouterModule.forChild(routes)],
    exports: [RouterModule]
})
export class DonneurRoutingModule {
}
