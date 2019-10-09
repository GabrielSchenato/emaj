import tipodemanda from './modules/tipodemanda'
import avaliacao from './modules/avaliacao'
import usuario from './modules/usuario'
import parametrostriagem from './modules/parametrostriagem'
import cliente from './modules/cliente'
import aluno from './modules/aluno'
import protocolo from './modules/protocolo'
import protocoloalunosprofessores from './modules/protocoloalunosprofessores'
import periodosaluno from './modules/periodosaluno'
import fichatriagem from './modules/fichatriagem'

export default {
    modules: {
        tipodemanda: tipodemanda,
        avaliacao: avaliacao,
        usuario: usuario,
        parametrostriagem: parametrostriagem,
        cliente: cliente,
        aluno: aluno,
        protocolo: protocolo,
        protocoloalunosprofessores: protocoloalunosprofessores,
        periodosaluno: periodosaluno,
        fichatriagem: fichatriagem
    }
}