const Menu =  [
  { header: 'Informações' },
  {
    title: 'Dashboard',
    group: 'apps',
    icon: 'dashboard',
    name: 'Dashboard',
  },  
  { divider: true },
  { header: 'Cadastros do Sistema' },
  {
    title: 'Cadastros',
    group: 'cadastros',
    component: 'cadastros',
    icon: 'add',
    items: [
      { name: 'usuarios', title: 'Usuários', component: 'cadastros/usuarios' },
      { name: 'clientes', title: 'Clientes', component: 'cadastros/clientes' },
      { name: 'tiposdemandas', title: 'Tipos de Demandas', component: 'cadastros/tiposdemandas' }
    ]
  },
  { divider: true },
  { header: 'Parametrização do Sistema' },
  {
    title: 'Parâmetros',
    group: 'parametros',
    component: 'parametros',
    icon: 'settings',
    items: [
      { name: 'triagem', title: 'Triagem', component: 'parametros/triagem' },  
    ]
  },
  { divider: true },
  { header: 'Movimentação do Sistema' },
  {
    title: 'Movimentos',
    group: 'movimentos',
    component: 'movimentos',
    icon: 'compare_arrows',
    items: [
      { name: 'fichastriagem', title: 'Fichas de Triagem', component: 'movimentos/fichastriagem' },
    ]
  },  
  { header: 'Estatísticas' },
  { divider: true },
  {
    title: 'Relatórios',
    group: 'forms',
    component: 'forms',
    icon: 'description',
    items: [
    ]
  },
  { divider: true },
  { header: 'Extras' },
  {
    title: 'Novidades',
    group: 'apps',
    name: 'Media',
    icon: 'fiber_new',
  },
];
// reorder menu
Menu.forEach((item) => {
  if (item.items) {
    item.items.sort((x, y) => {
      let textA = x.title.toUpperCase();
      let textB = y.title.toUpperCase();
      return (textA < textB) ? -1 : (textA > textB) ? 1 : 0;
    });
  }
});

export default Menu;
