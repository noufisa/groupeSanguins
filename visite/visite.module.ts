import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {PageHeaderModule} from "../../shared/modules";
import { VisiteComponent} from "./visite.component";
import {VisiteRoutingModule} from "./visite-routing.module";
import {FormsModule} from "@angular/forms";

@NgModule({
  declarations: [VisiteComponent],
    imports: [CommonModule, VisiteRoutingModule, PageHeaderModule, FormsModule]
})
export class VisiteModule { }
