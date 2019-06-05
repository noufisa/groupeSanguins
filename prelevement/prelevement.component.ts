import { Component, OnInit } from '@angular/core';
import {Prelevement, PrelevementService} from "../../services/prelevement.service";
import {ActivatedRoute, Router} from "@angular/router";
import {Donneur, DonneurService} from "../../services/donneur.service";

@Component({
  selector: 'app-prelevement',
  templateUrl: './prelevement.component.html',
  styleUrls: ['./prelevement.component.scss']
})
export class PrelevementComponent implements OnInit {
    addP:boolean=false;
    donneur=new Donneur();
    p=new Prelevement();
    pre:Prelevement[];
  constructor(public prelevementService:PrelevementService,public router: Router,
              public donneurService:DonneurService,
  private route:ActivatedRoute) { }

   async ngOnInit() {
    const id=+this.route.snapshot.params.id;
       console.log(id);
       this.donneur = await this.donneurService.get(id);
       console.log(this.donneur);
   }
    async addPre(){
        this.p.donneur=this.donneur;
        console.log(this.p);
        const p= await  this.prelevementService.addPre(this.p);

    }
    async deleteP(id:number){
        await this.prelevementService.deleteP(id);
    }
    /*async getD(id:number){
         await this.donneurService.get(id);
    }
  /*async getP(id:number){
        this.pre=await this.prelevementService.getPre(id);
  }*/

}
