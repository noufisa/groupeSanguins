import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {PageHeaderModule} from "../../shared/modules";
import {FormsModule} from "@angular/forms";
import {QuestionComponent} from "./question.component";
import {QuestionRoutingModule} from "./question-routing.module";

@NgModule({
  declarations: [QuestionComponent],
    imports: [CommonModule, QuestionRoutingModule, PageHeaderModule, FormsModule]
})
export class QuestionModule { }
