import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Routes, RouterModule } from '@angular/router';

import { IonicModule } from '@ionic/angular';

import { PrimeiraPaginaPage } from './primeira-pagina.page';

const routes: Routes = [
  {
    path: '',
    component: PrimeiraPaginaPage
  }
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    RouterModule.forChild(routes)
  ],
  declarations: [PrimeiraPaginaPage]
})
export class PrimeiraPaginaPageModule {}
