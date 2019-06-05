import { Component, OnInit } from '@angular/core';
import {Donneur, DonneurService} from "../../services/donneur.service";
import {Router} from "@angular/router";

@Component({
  selector: 'app-donneur',
  templateUrl: './donneur.component.html',
  styleUrls: ['./donneur.component.scss']
})
export class DonneurComponent implements OnInit {
    donneur:Donneur[];
  constructor(public router: Router,public donneurService:DonneurService) { }

  async ngOnInit() {
      this.donneur=await this.donneurService.getAllDonneur();
  }
  async deleteD(id:number){
      await this.donneurService.deleteD(id);
  }

}
