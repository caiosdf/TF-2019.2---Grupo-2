import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';


const routes: Routes = [
  {
    path: '',
    loadChildren: () => import('./primeira-pagina/primeira-pagina.module').then(m => m.PrimeiraPaginaPageModule)
  },
  {
    path: '',
    loadChildren: () => import('./tabs/tabs.module').then(m => m.TabsPageModule)
  },

  { path: 'login', loadChildren: './login/login.module#LoginPageModule' },
  { path: 'cadastro', loadChildren: './cadastro/cadastro.module#CadastroPageModule' },
  { path: 'home', loadChildren: './home/tab1.module#Tab1PageModule' },
  { path: 'primeira-pagina', loadChildren: './primeira-pagina/primeira-pagina.module#PrimeiraPaginaPageModule' },
  { path: 'postnovo', loadChildren: './postnovo/postnovo.module#PostnovoPageModule' },  { path: 'altera-email', loadChildren: './altera-email/altera-email.module#AlteraEmailPageModule' },



];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule {}


