const Versoes = [
    {
        id: 1,
        nome: 'v1.0.0',
        data: '13 de maio de 2019',
        alteracoesPortal: [
            {
                descricao: 'Evolução (Cadastro): Criado área para o cadastro de "Usuários"'
            },
            {
                descricao: 'Evolução (Cadastro): Criado área para a edição do perfil do usuário logado'
            },
            {
                descricao: 'Evolução (Cadastro): Criado área para o cadastro de "Tipo de Demandas"'
            },
            {
                descricao: 'Evolução (Cadastro): Criado área para o cadastro de "Tipo de Status"'
            },
            {
                descricao: 'Evolução (Cadastro): Criado área para o cadastro de "Parâmetros da Triagem"'
            },
            {
                descricao: 'Evolução (Movimento): Criado área para o cadastro de "Ficha de Triagem"'
            },
            {
                descricao: 'Evolução (Movimento): Criado relatório para a impressão dos dados das partes na "Ficha de Triagem"'
            },
            {
                descricao: 'Evolução (Movimento): Criado relatório para a impressão do protocolo da "Ficha de Triagem"'
            },
            {
                descricao: 'Evolução (Alterações): Criado área para a visualização das alterações na plataforma"'
            }
        ],
        alteracoesInstitucional: [
            {
                descricao: 'Evolução (Início): Criado página "Início" com conteúdos sobre o EMAJ'
            },
            {
                descricao: `Evolução (Sobre): Criado página "Sobre" <small class="font-weight-bold font-italic">(em construção)</small>`
            },
            {
                descricao: `Evolução (Como Funciona): Criado página "Como Funciona" <small class="font-weight-bold font-italic">(em construção)</small>`
            },
            {
                descricao: `Evolução (Contato): Criado página "Contato" <small class="font-weight-bold font-italic">(em construção)</small>`
            }
        ]
    },
    {
        id: 2,
        nome: 'v1.0.1',
        data: '20 de maio de 2019',
        alteracoesPortal: [
            {
                descricao: 'Adaptação (Cadastro): Removido a obrigatoriedade do campo "Descrição" no cadastro de telefones do cliente'
            },
            {
                descricao: 'Adaptação (Cadastro): Aumentado o tamanho do campo "Despesas" no cadastro da Composição Familiar do cliente'
            },
            {
                descricao: 'Correção (Movimento): Aplicada correção na impressão do relatório da "Ficha de Triagem"'
            },
            {
                descricao: 'Adaptação (Movimento): Ajustado para poder digitar o nome do aluno, ao invés de cadastrar na tela de "Usuários"'
            },
            {
                descricao: 'Adaptação (Movimento): Ajustado a tela de "Ficha de Triagem", assim incluindo o botão de "+" para cadastrar novos clientes/parte contrárias e tipos de demanda'
            },
            {
                descricao: 'Adaptação (Movimento): Ajustado a tela de "Ficha de Triagem", mudando a forma de busca dos campos "Cliente", "Parte Contrária" e "Tipo de Demanda" para só buscar assim que digitar três caracteres'
            }
        ],
        alteracoesInstitucional: [

        ]
    },
    {
        id: 3,
        nome: 'v1.0.2',
        data: '22 de maio de 2019',
        alteracoesPortal: [
            {
                descricao: 'Correção (Cadastro): Aplicada correção nos campos "Renda", "Renda Familiar" e "Valor Patrimônio", corrigindo dessa forma o campo moeda no cadastro do "Cliente"'
            },
            {
                descricao: 'Adaptação (Movimento): Removido a obrigatoriedade dos campos "Tipo de Demanda" e "Tipo de Status". Habilitado também o campo "Protocolo" para edição na ação de editar na tela de "Ficha de Triagem"'
            },
            {
                descricao: 'Adaptação (Movimento): Adicionado o campo "Professor" na tela de "Ficha de Triagem"'
            },
            {
                descricao: 'Adaptação (Cadastro): Adicionado o campo "CPF Representado/Assistido" e "RG Representado/Assistido" na tela de cadastro de "Cliente"'
            },
            {
                descricao: 'Adaptação (Movimento): Aplicada diversas modificações na impressão da "Ficha de Triagem", incluindo novos campos e layout melhorado'
            }
        ],
        alteracoesInstitucional: [

        ]
    },
    {
        id: 4,
        nome: 'v1.0.3',
        data: '28 de maio de 2019',
        alteracoesPortal: [
            {
                descricao: 'Adaptação (Movimento): Aplicada melhoria na impressão da "Ficha de Triagem", aumentando o campo "Local Trabalho"'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria na tela de cadastro de "Clientes", removendo a obrigatoriedade do campo "Local de Trabalho"'
            },
            {
                descricao: 'Adaptação (Movimento): Ajustado a tela de "Ficha de Triagem", assim incluindo o botão de "+" para cadastrar novas parte contrárias'
            },
            {
                descricao: 'Adaptação (Movimento): Ajustado a tela de cadastro de "Ficha de Triagem", incluído campo "Número Processo"'
            },
            {
                descricao: 'Adaptação (Movimento): Ajustado a tela de cadastro de "Ficha de Triagem", incluído campo "Ativo"'
            },
            {
                descricao: 'Adaptação (Movimento): Ajustado a tela de exibição de "Ficha de Triagem", para mostrar os campos "N.º Processo" e "Ativo"'
            },
            {
                descricao: 'Adaptação (Cadastro): Removido o cadastro "Tipo de Status"'
            },
            {
                descricao: 'Adaptação (Movimento): Ajustado a tela de cadastro "Ficha de Triagem", para atualizar o status da ficha automaticamente quando preencher o campo "Número Processo"'
            },
            {
                descricao: 'Adaptação (Cadastro): Criado tela para o cadastro "Alunos"'
            },
            {
                descricao: 'Adaptação (Movimento): Ajustada a tela de cadastro "Ficha de Triagem" para buscar os alunos cadastrados no sistema'
            },
            {
                descricao: 'Adaptação (Cadastro): Adicionado campo "Professor?" no cadastro de "Usuários"'
            },
            {
                descricao: 'Adaptação (Movimento): Ajustada a tela de cadastro "Ficha de Triagem" para buscar os professores cadastrados no sistema'
            },
            {
                descricao: 'Adaptação (Movimento): Aplicada melhorias na impressão da "Ficha de Triagem"'
            },
            {
                descricao: 'Correção (Cadastro): Aplicada correção no campo "Renda", "Valor Patrimônio" e "Renda Familiar", corrigindo dessa forma a validação dos mesmos'
            }
        ],
        alteracoesInstitucional: [

        ]
    },
    {
        id: 5,
        nome: 'v1.0.4',
        data: '10 de junho de 2019',
        alteracoesPortal: [
            {
                descricao: 'Adaptação (Movimento): Aplicada melhoria na impressão da "Ficha de Triagem", diminuindo o tamanho da impressão'
            },
            {
                descricao: 'Adaptação (Movimento): Aplicada melhoria em todas as grids, melhorando o filtro de busca do registros'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria em todas as grids, melhorando o filtro de busca do registros'
            }
        ],
        alteracoesInstitucional: [
            {
                descricao: 'Correção (Início): Aplicada correção na tela "Início", corrigindo dessa forma o horário de funcionamento'
            }
        ]
    },
    {
        id: 6,
        nome: 'v1.0.5',
        data: '27 de junho de 2019',
        alteracoesPortal: [
            {
                descricao: 'Adaptação (Movimento): Aplicada melhoria na listagem de Ficha de Triagens, destacando de vermelho o nome da Parte Contrária'
            },
            {
                descricao: 'Adaptação (Dashboard): Aplicada melhoria na Dashboard, destando a quantidade de "Alunos", "Clientes", "Parte Contrárias" e "Atendimentos Mês"'
            }
        ],
        alteracoesInstitucional: [

        ]
    },
    {
        id: 7,
        nome: 'v1.0.6',
        data: '23 de julho de 2019',
        alteracoesPortal: [
            {
                descricao: 'Adaptação (Alterações): Aplicada melhoria na listagem de alterações da plataforma'
            },
            {
                descricao: 'Correção (Padrão): Aplicada correção quando fica muito tempo sem acessar a plataforma, e ao entrar não carregava os dados'
            }
        ],
        alteracoesInstitucional: [

        ]
    },
    {
        id: 8,
        nome: 'v1.1.0',
        data: '31 de julho de 2019',
        alteracoesPortal: [
            {
                descricao: 'Adaptação (Padrão): Aplicada melhoria na tela de Login da plataforma'
            },
            {
                descricao: 'Evolução (Cadastro): Criado no cadastro do aluno uma nova aba "Clientes", onde é possível visualizar todos os clientes em que o aluno está vinculado'
            },
            {
                descricao: 'Evolução (Cadastro): Criado no cadastro do aluno uma nova aba "Avaliações", onde é possível criar avaliações dos atendimentos dos alunos'
            },
            {
                descricao: 'Evolução (Cadastro): Criado no cadastro do aluno na ação de editar na aba "Avaliações" um novo campo "Anexos", onde é possível inserir arquivos com tamanho máximo de 10MB vinculado com as avaliações dos atendimentos dos alunos'
            },
            {
                descricao: 'Adaptação (Movimento): Adicionado máscara no campo "Número Processo"'
            }
        ],
        alteracoesInstitucional: [
            {
                descricao: 'Adaptação (Institucional): Aplicada melhoria na logo da Uniplac e do EMAJ'
            },
            {
                descricao: 'Evolução (Institucional): Criada página Contato'
            },
            {
                descricao: 'Adaptação (Institucional): Ajustado os conteúdos da página inicial'
            },
            {
                descricao: 'Evolução (Institucional): Criada página Como Funciona com informações sobre o EMAJ'
            }
        ]
    },
    {
        id: 9,
        nome: 'v2.0.0',
        data: '26 de agosto de 2019',
        alteracoesPortal: [
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria na tela de "Alunos" na aba "Avaliações" para quando clicar na linha expandir a mesma e mostrar mais informações sobre a avaliação'
            },
            {
                descricao: 'Adaptação (Cadastro): Implementado uma nova aba no cadastro do "Cliente" chamada "Protocolos" onde é possível adicionar vários protocolos para o mesmo cliente.\n\
                        No cadastro do protocolo foram criados os campos "Protocolo" onde este é obrigatório, e os demais não obrigatórios como, "Número Processo", "Parte Contrária", "Tipo de Demanda" e "Observações"'
            },
            {
                descricao: 'Adaptação (Cadastro): Implementado dentro do cadastro do protocolo, uma nova aba chamada "Alunos/Professores Vinculados" a onde está, lista e permite o cadastro de "Aluno", "Professor" e "Data Vínculo"\n\
                        estes campos obrigatórios'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria no cadastro do "Aluno" renomeando a aba "Avaliações" para "Observações"'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria no cadastro do "Aluno" na aba "Observações", agora possui um campo "Protocolo" não obrigatório, onde é possível puxar todos os protocolos em que o aluno está vinculado'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria no cadastro do "Cliente" na "Protocolos", agora possui uma nova ação que permite imprimir a ficha de triagem do cliente'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhorias na impressão da Ficha de Triagem'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria no cadastro do "Aluno" na aba "Clientes", para buscar os vinculos realizados através dos protocolos'
            },
            {
                descricao: 'Adaptação (Dashboard): Alterada a forma de buscar as estatísticas da Ficha de Triagem para Protocolos'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria na impressão da Ficha de Triagem, para exibir os campos da Parte Contrária mesmo quando não tenha uma'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria no cadastro de "Cliente", na aba "Protocolos" incluindo a opção de clicar sobre a linha do registro e expandir para visualizar os alunos e professores vinculados ao protocolo'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria no cadastro de "Cliente", na aba "Protocolos" incluindo um aviso quando o cliente já foi uma parte contrária'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria no cadastro de "Cliente", para quando salvar o mesmo e não ser uma parte contrária manter a janela aberta para inserir protocolos'
            },
            {
                descricao: 'Adaptação (Movimento): Removido do menu as movimentações de Ficha de Triagens'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria no cadastro de "Cliente", na aba "Protocolos", no campo "Protocolo" validando o mesmo para só permitir salvar se o valor estiver seguindo o padrão #####/##'
            }
        ],
        alteracoesInstitucional: [
            {
                descricao: 'Adaptação (Início): Alterada a forma de buscar as estatísticas da Ficha de Triagem para Protocolos'
            }
        ]
    },
    {
        id: 10,
        nome: 'v2.0.1',
        data: '05 de setembro de 2019',
        alteracoesPortal: [
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria nos campos obrigatórios para melhor visibilidade dos mesmos'
            },
            {
                descricao: 'Correção (Cadastro): Aplicada correção no cadastro de "Cliente" onde em algumas situações ao abrir um cadastro antigo o parâmetro "Parte Contrária?" era marcado de forma incorreta'
            }
        ],
        alteracoesInstitucional: [

        ]
    },
    {
        id: 11,
        nome: 'v2.0.2',
        data: '13 de setembro de 2019',
        alteracoesPortal: [
            {
                descricao: 'Adaptação (Cadastro): Aplicada melhoria na impressão da "Ficha de Triagem", aumentando dessa forma o tamanho do campo "Data" para facilitar a escrita dos professores'
            }
        ],
        alteracoesInstitucional: [

        ]
    },
    {
        id: 12,
        nome: 'v2.1.0',
        data: '30 de setembro de 2019',
        alteracoesPortal: [
            {
                descricao: 'Evolução (Relatório): Criado novo módulo "Relatórios"'
            },
            {
                descricao: 'Evolução (Relatório): Criado novo relatório "Atividades Prestadas", onde o mesmo traz o total de atendimentos por mês com seus respectivos nomes quando escolhido o tipo "Analítico" e o "Sintético" onde traz informações resumidas com o total apenas'
            },
            {
                descricao: 'Evolução (Relatório): Criado novo relatório "Professores e Alunos", onde o mesmo traz a quantidade e o vínculo de professores e alunos'
            },
            {
                descricao: 'Evolução (Cadastro): Aplicado melhoria nos campos de busca para realizar buscar por ID (Código)'
            },
            {
                descricao: 'Adaptação (Padrão): Aplicado melhoria na exibição das alterações na plataforma'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicado melhoria no cadastro de "Aluno", onde agora possui uma nova aba "Períodos" onde é possível vincular o dia em que o aluno faz o estágio'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicado melhoria no cadastro de "Aluno", removido o campo "Fase", "Ano", "Semestre" e "Turno". O campo "Disciplina" agora é obrigatório'
            },
            {
                descricao: 'Evolução (Relatório): Criado novo relatório "Dias e Períodos dos Alunos", onde o mesmo traz o período e a disciplina que o aluno estagia'
            },
            {
                descricao: 'Evolução (Relatório): Criado novo relatório "Clientes e Protocolos", onde o mesmo traz os protocolos ativos e inativos que um cliente possui'
            },
            {
                descricao: 'Adaptação (Cadastro): Aplicado melhoria no cadastro de "Cliente", removida a obrigatoriedade do campo "Renda"'
            },
        ],
        alteracoesInstitucional: [

        ]
    },
];

/**
 * Método responsável por retornar uma versão pelo seu ID.
 * @param {int} id
 * 
 * @returns {Object}
 */
const getVersaoById = (id) => {
    return (id === undefined) ? Versoes[0] : Versoes.find(x => x.id === id);
};

/**
 * Método responsável por retornar uma parte das versões se informado o limite, ou
 * tudo se não informar o limite.
 * 
 * @param {int} limite
 * @returns {Array}
 */
const getVersoes = (limite) => {
    return (limite) ? Versoes.slice(0, limite) : Versoes;
};

/**
 * Método responsável por retornar as versões ordenado.
 * 
 * @returns {Array}
 */
const getVersoesOrdenado = () => {
    return [...Versoes].sort((a, b) => a.id > b.id ? -1 : 1);
};

/**
 * Método responsável por retornar a última versão.
 * 
 * @returns {Object}
 */
const getLastVersao = () => {
    return _.last(Versoes);
};

export default{
    Versoes,
    getVersoes,
    getVersaoById,
    getLastVersao,
    getVersoesOrdenado
};