import { Component, OnInit } from '@angular/core';
import {Question, QuestionService} from "../../services/question.service";
import {Router} from "@angular/router";

@Component({
  selector: 'app-question',
  templateUrl: './question.component.html',
  styleUrls: ['./question.component.scss']
})
export class QuestionComponent implements OnInit {
    q=new Question();
    qs: Question[];
  constructor(public questionService:QuestionService,
              public router: Router) { }
  async ngOnInit() {
      this.qs=await this.questionService.getAllQ();
  }
  async addQuestion(){
      console.log(this.q);
      const q= await  this.questionService.createQ(this.q);
  }
  async deletQ(id:number){
      await this.questionService.deleteQ(id);
      //alert("Delete")
  }

}
