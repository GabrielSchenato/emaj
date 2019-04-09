const Menu =  [
  { header: 'Informações' },
  {
    title: 'Dashboard',
    group: 'apps',
    icon: 'dashboard',
    name: 'Dashboard'
  },  
  { divider: true },
  { header: 'Cadastros do Sistema', role: ['admin', 'secretaria'] },
  {
    title: 'Cadastros',
    group: 'cadastros',
    component: 'cadastros',
    icon: 'add',
    itens: [
      { name: 'usuarios', title: 'Usuários', component: 'cadastros/usuarios', role: ['admin', 'secretaria'] },
      { name: 'clientes', title: 'Clientes', component: 'cadastros/clientes', role: ['admin', 'secretaria'] },
      { name: 'tipodemandas', title: 'Tipo de Demandas', component: 'cadastros/tipodemandas', role: ['admin', 'secretaria'] }
    ],
    role: ['admin', 'secretaria']
  },
  { divider: true },
  { header: 'Parametrização do Sistema', role: ['admin'] },
  {
    title: 'Parâmetros',
    group: 'parametros',
    component: 'parametros',
    icon: 'settings',
    itens: [
      { name: 'triagem', title: 'Triagem', component: 'parametros/triagem' },  
    ], 
    role: ['admin']
  },
  { divider: true },
  { header: 'Movimentação do Sistema' },
  {
    title: 'Movimentos',
    group: 'movimentos',
    component: 'movimentos',
    icon: 'compare_arrows',
    itens: [
      { name: 'fichastriagem', title: 'Fichas de Triagem', component: 'movimentos/fichastriagem' },
    ]
  },  
  /*{ header: 'Estatísticas' },
  { divider: true },
  {
    title: 'Relatórios',
    group: 'forms',
    component: 'forms',
    icon: 'description',
    itens: [
    ]
  },*/
  /*{ divider: true },
  { header: 'Extras' },
  {
    title: 'Novidades',
    group: 'apps',
    name: 'Media',
    icon: 'fiber_new',
  },*/
];
// reorder menu
Menu.forEach((item) => {
  if (item.itens) {
    item.itens.sort((x, y) => {
      let textA = x.title.toUpperCase();
      let textB = y.title.toUpperCase();
      return (textA < textB) ? -1 : (textA > textB) ? 1 : 0;
    });
  }
});

export default Menu;
