const Items = [
  {
    'id': 1,
    'nome': 'Dessie',
    'sobrenome': 'Vat',
    'email': 'Hobart_Mueller.Thiel@hotmail.com',
    'telefone': '1-360-812-9380 x511',
    'avatar': '/static/avatar/a2.jpg',
    'permissao': {
      'id': 1,
      'nome': 'Administrador'
    }
  },
  {
    'id': 2,
    'nome': 'Hobart',
    'sobrenome': 'Avas',
    'email': 'Dessie7937@gmail.com',
    'telefone': '1-3349-812-9380 3349',
    'avatar': '/static/avatar/a1.jpg',
    'permissao': {
      'id': 2,
      'nome': 'Secretária'
    }
  },
  {
    'id': 3,
    'nome': 'Celestine',
    'sobrenome': 'Avbty',
    'email': 'Celestine.Casper59@hotmail.com',
    'telefone': '1-3349-4564562-90 3349',
    'avatar': '/static/avatar/a3.jpg',
    'permissao': {
      'id': 3,
      'nome': 'Aluno'
    }
  },
];

const getUserById = (uuid) => {
  return (uuid === undefined) ? Items[0] : Items.find(x => x.uuid === uuid);
};

const getUser = (limit) => {
  return (limit) ? Items.slice(0, limit) : Items;
};

export {
  Items,
  getUser,
  getUserById
};