var chai = require('chai'),
  chaiHttp = require('chai-http');

var expect = chai.expect;

chai.use(chaiHttp);

describe('ListCandidate', () => {
  
  it('Testar o GET de todos os Técnicos', (done) => {
    chai.request('http://localhost:8000')
      .get('/api/candidates')
      .end((err, res) => {
        expect(err).to.be.null;
        expect(res).to.have.status(200);
        done();
      })
  });
})

describe('FormCandidate', () => {

  it('Testar o POST do form de Técnico', (done) => {
    chai.request('http://localhost:8000')
      .post('/api/candidates')
      .send({"name":"Luiz Cavalcanti","cpf":"38680125083","email":"luiz@gmail.com","date_birth":"27/03/1992","address":"Rua dos Agrônomos, 121","stacks":["Python","Java","PHP","Javascript","Laravel"]})
      .end((err, res) => {
        expect(err).to.be.null;
        expect(res).to.have.status(200);
        done();
      })
  });
})