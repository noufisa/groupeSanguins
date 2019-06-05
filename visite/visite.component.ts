import { Component, OnInit } from '@angular/core';
import {Visite, VisiteService} from "../../services/visite.service";
import {Question} from "../../services/question.service";
import {Router} from "@angular/router";

@Component({
  selector: 'app-visite',
  templateUrl: './visite.component.html',
  styleUrls: ['./visite.component.scss']
})
export class VisiteComponent implements OnInit {
visite=new Visite();
    qs: Question[];
  constructor(public visiteService: VisiteService,public router: Router){ }

  async ngOnInit() {
      this.qs=await this.visiteService.loadQ();
  }
  async addVisite(){
      await this.visiteService.createVisite(this.visite);

  }


}
