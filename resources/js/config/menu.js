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
    group: 'components',
    component: 'components',
    icon: 'add',
    items: [
      { name: 'usuarios', title: 'Usuários', component: 'components/alerts' },
      { name: 'clientes', title: 'Clientes', component: 'components/avatars' },
      { name: 'tipodemanda', title: 'Tipo de Demanda', component: 'components/badges' }
    ]
  },
  { divider: true },
  { header: 'Parametrização do Sistema' },
  {
    title: 'Parâmetros',
    group: 'pickers',
    component: 'picker',
    icon: 'settings',
    items: [
      { name: 'triagem', title: 'Triagem', component: 'components/bottom-sheets' },
    ]
  },
  { divider: true },
  { header: 'Movimentação do Sistema' },
  {
    title: 'Movimentos',
    group: 'layout',
    component: 'layout',
    icon: 'compare_arrows',
    items: [
      { name: 'fichatriagem', title: 'Ficha de Triagem', component: 'components/expansion-panels' },
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
