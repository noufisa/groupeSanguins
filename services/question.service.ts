import { Injectable } from '@angular/core';
import {ApiService} from "./api.service";
import {promise} from "selenium-webdriver";
import {Reponse} from "./reponse.service";


@Injectable({
  providedIn: 'root'
})
export class QuestionService {
    qs:Question[];
    constructor(private apiService: ApiService) {
    }

    async createQ(q: Question) {
        try {
            const ques: Question = await this.apiService.call('addQ', 'post', q).toPromise();
            if (q.id === 0) {
                this.qs.push(ques);
            }
            return true;
        }catch(e){
            return false;
        }
    }
    async getQ(id:number){
        return await this.apiService.call('getQuestion/'+id, 'get', null);
    }
    async getAllQ():Promise<Question[]>{
       this.qs= await this.apiService.call('getAll','get', null).toPromise();
       return this.qs;
    }
    async deleteQ(id:number){
        try {
            await this.apiService.call('deleteQ/' + id, 'delete', null).toPromise();
            this.qs.splice(this.qs.indexOf(this.qs.find((c) => {
                return c.id === id
            })), 1);
            return true;
        }catch(e)
        {
            return false;
        }
    }

}
export class Question {
    id:number;
    question:string;
    reponse:Reponse;
    constructor() {
        this.id = 0;
    }}
