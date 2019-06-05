import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {PageHeaderModule} from "../../shared/modules";
import {FormsModule} from "@angular/forms";
import {PrelevementComponent} from "./prelevement.component";
import {TestComponent} from "../test/test.component";
import {PrelevementRoutingModule} from "./prelevement-routing.module";

@NgModule({
  declarations: [PrelevementComponent,TestComponent],
    imports: [CommonModule, PrelevementRoutingModule, PageHeaderModule, FormsModule]
})
export class PrelevementModule { }
