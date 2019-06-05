import { Injectable } from '@angular/core';
import { ApiService } from './api.service';

@Injectable({
  providedIn: 'root'
})
export class MedecinService {

  constructor(private apiService: ApiService) { }
  async createMedecin(medecin: Medecin) {
    return await this.apiService.call('addM', 'post', medecin);
  }
  async deleteMedecin(medecin: Medecin) {
    return await this.apiService.call('post/'+ medecin.id, 'delete', null);
  }

}
export class Medecin {
  id: number;
  nom: string;
  prenom: string;
  tel: string;
}
