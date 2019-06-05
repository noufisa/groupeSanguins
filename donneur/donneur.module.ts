import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {PageHeaderModule} from "../../shared/modules";
import {FormsModule} from "@angular/forms";
import {DonneurComponent} from "./donneur.component";
import {QuestionRoutingModule} from "../question/question-routing.module";
import {DonneurRoutingModule} from "./donneur-routing.module";
import {PrelevementComponent} from "../prelevement/prelevement.component";

@NgModule({
  declarations: [DonneurComponent,PrelevementComponent],
    imports: [CommonModule, DonneurRoutingModule, PageHeaderModule, FormsModule]
})
export class DonneurModule { }
