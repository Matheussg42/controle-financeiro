import React, { useState, useEffect } from 'react';
import Header from '../../components/Header'
import { Container, TableBody, Table, TableCell ,TableContainer, TableHead, TableRow, TextField, Grid  } from '@material-ui/core';
import { FiTrash } from 'react-icons/fi';
import api from '../../services/api';
import './styles.css';

export default function Financas() {
  const [payments, setPayments] = useState([]);
  const [totalPayment, setTotalPayments] = useState([]);
  
  const [incomes, setIncomes] = useState([]);
  const [totalIncome, setTotalIncome] = useState([]);

  const [thisMonth, setThisMonth] = useState([]);
  
  const [paymentName, setPaymentName] = useState('');
  const [paymentValue, setPaymentValue] = useState(0);
  const [paymentDate, setPaymentDate] = useState('');
  const [paymentComment, setPaymentComment] = useState('');
  
  const [incomeName,    setIncomeName] = useState('');
  const [incomeValue,   setIncomeValue] = useState(0);
  const [incomeDate,    setIncomeDate] = useState('');
  const [incomeComment, setIncomeComment] = useState('');
  
  const [insertForm, setInsertForm] = useState(1);
  const [token] = useState(localStorage.getItem('token'));

  useEffect(() => {
    api.get('api/v1/currentMonth', {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      setThisMonth(response.data.data);
    }).catch(err => {
      setThisMonth(false);
    })
  }, []);

  useEffect(() => {
    if(thisMonth != false){
      api.get('api/v1/currentMonth/payment/', {
        headers: {
          Authorization: `Bearer ${token}`,
        }
      }).then(response => {
        setPayments(response.data.data);
      })

      api.get('api/v1/currentMonth/income/', {
        headers: {
          Authorization: `Bearer ${token}`,
        }
      }).then(response => {
        setIncomes(response.data.data);
      })
    }
  }, [thisMonth]);
  
  useEffect(() => {
    getTotalPayment();
  }, [payments]);
  
  useEffect(() => {
    getTotalIncome();
  }, [incomes]);

  const handleDeletePayment = (id) => {
    api.delete(`api/v1/payments/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      const filteredPayments = payments.filter( function(elem) {
        return elem.id !== id;
      });
      setPayments(filteredPayments);
    })
  }
  
  const handleDeleteIncomes = (id) => {
    api.delete(`api/v1/income/${id}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      const filteredIncomes = incomes.filter( function(elem) {
        return elem.id !== id;
      });
      setIncomes(filteredIncomes);
    })
  }

  const handleSubmitPayment = (e) =>{
    e.preventDefault();

    const data ={
      "yearMonth": thisMonth.id,
      "value": paymentValue,
      "date": paymentDate,
      "name": paymentName,
      "comment": paymentComment
    };

    api.post(`api/v1/payments/`, data, {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      setPayments([...payments, response.data.data]);
    })

    setPaymentName('');
    setPaymentValue('');
    setPaymentDate('');
    setPaymentComment('');
  }
  
  const handleSubmitIncome = (e) =>{
    e.preventDefault();

    const data ={
      "yearMonth": thisMonth.id,
      "value": incomeValue,
      "name": incomeName,
      "date": incomeDate,
      "comment": incomeComment.length === 0 ? '' : incomeComment
    };


    api.post(`api/v1/income`, data, {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      setIncomes([...incomes, response.data.data]);
    }).catch(err => {
      console.log(err)
    })

    setIncomeName('');
    setIncomeValue('');
    setIncomeDate('');
    setIncomeComment('');
  }

  const changeInsertForm = (form) =>{
    setInsertForm(form);
  }

  const getTotalPayment = () => {
    let itemTotal = 0;
    payments.map((item) => {
      return itemTotal = parseInt(itemTotal) + parseInt(item.Value);
    });

    setTotalPayments(itemTotal);
  }

  const getTotalIncome = () => {
    let itemTotal = 0;
    incomes.map((item) => {
      return itemTotal = parseInt(itemTotal) + parseInt(item.Value);
    });

    setTotalIncome(itemTotal);
  }

  const openMonth = () =>{
    api.post(`api/v1/months/`, {}, {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      setThisMonth(response.data.data);
    }).catch(err => {
      console.log(err)
    })
  }
  
  const closeMonth = () =>{
    const data ={
      "received": parseInt(totalIncome),
      "paid": parseInt(totalPayment)
    };

    api.put(`api/v1/closeMonth/${thisMonth.id}`, data, {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      setThisMonth(false);
    })
  }

  return (
    <React.Fragment>
      <Header />
      
      <Container maxWidth="xl">
        <Grid container>
          <Grid item xs={8}></Grid>
          <Grid item xs={4}>
            <div className={`totalBox topBar`}>
              <button onClick={() => {closeMonth()}} className={`${thisMonth === false || (thisMonth && thisMonth.Status === 'fechado')? 'display-none' : ''}`} type="submit">Fechar Mês</button>
              <button onClick={() => {openMonth()}} className={`${thisMonth === false ? '' : 'display-none'}`} type="submit">Abrir Mês</button>
              {thisMonth != false && thisMonth && thisMonth.Status === 'fechado'? <p className="msg erro">O Mês atual já foi fechado.</p> : ''}
            </div>
          </Grid>
        </Grid>
      </Container>

      <Container maxWidth="xl">
        <Grid container>
          <Grid item xs={3}>
            <a className={`insertFormButton ${insertForm ===1 ? 'active' :''}`} onClick={()=>changeInsertForm(1)}>Pagamento</a>
            <a className={`insertFormButton ${insertForm ===2 ? 'active' :''}`} onClick={()=>changeInsertForm(2)}>Recebimentos</a>
            {insertForm ===1 ?(
              <div className="form">
                <strong>Cadastrar Pagamento</strong>
                <form noValidate autoComplete="off" onSubmit={handleSubmitPayment}>
                  <TextField 
                    name="paymentName" 
                    id="paymentName" 
                    label="Titulo da Compra"
                    className="TextFieldBlock" 
                    value={paymentName} 
                    onChange={e => setPaymentName(e.target.value)} 
                    required
                  />

                  <div className="input-group">
                    <TextField 
                      name="paymentValue" 
                      id="paymentValue" 
                      label="Valor" 
                      className="TextFieldInput"
                      value={paymentValue} 
                      onChange={e => setPaymentValue(e.target.value)} 
                      required
                    />
                    
                    <TextField 
                      name="paymentDate" 
                      id="paymentDate" 
                      label="Data: __/__/__" 
                      className="TextFieldInput"
                      value={paymentDate} 
                      onChange={e => setPaymentDate(e.target.value)} 
                      required
                    />
                  </div>

                  <TextField 
                    name="paymentComment" 
                    id="paymentComment" 
                    label="Comentário"
                    className="TextFieldBlock" 
                    value={paymentComment} 
                    onChange={e => setPaymentComment(e.target.value)} 
                    required
                    multiline
                  />

                  <button type="submit">Salvar</button>
                </form>
              </div>) : (
                <div className="form">
                  <strong>Cadastrar Recebimentos</strong>
                  <form noValidate autoComplete="off" onSubmit={handleSubmitIncome}>
                    <TextField 
                      name="incomeName" 
                      id="incomeName" 
                      label="Titulo"
                      className="TextFieldBlock" 
                      value={incomeName} 
                      onChange={e => setIncomeName(e.target.value)} 
                      required
                    />
    
                    <div className="input-group">
                      <TextField 
                        name="incomeValue" 
                        id="incomeValue" 
                        label="Valor" 
                        className="TextFieldInput"
                        value={incomeValue} 
                        onChange={e => setIncomeValue(e.target.value)} 
                        required
                      />
                      
                      <TextField 
                        name="incomeDate" 
                        id="incomeDate" 
                        label="Data: __/__/__" 
                        className="TextFieldInput"
                        value={incomeDate} 
                        onChange={e => setIncomeDate(e.target.value)} 
                        required
                      />
                    </div>
    
                    <TextField 
                      name="incomeComment" 
                      id="incomeComment" 
                      label="Comentário"
                      className="TextFieldBlock" 
                      value={incomeComment} 
                      onChange={e => setIncomeComment(e.target.value)} 
                      required
                      multiline
                    />
    
                    <button type="submit">Salvar</button>
                  </form>
                </div>
              )}
          </Grid>

          <Grid item xs={1}></Grid>
          
          <Grid item xs={4}>
            <TableContainer className="tableContainer tableGrid">

              <h3 className="tableTitle">Pagamentos</h3>
              <Table stickyHeader aria-label="sticky table">
                <TableHead>
                  <TableRow>
                    <TableCell>Titulo</TableCell>
                    <TableCell align="right">Data</TableCell>
                    <TableCell align="right">Valor</TableCell>
                    <TableCell align="right">Deletar</TableCell>
                  </TableRow>
                </TableHead>
                <TableBody>
                  {payments.length > 0 ? payments.map((payment) => 
                    (
                      <TableRow key={payment.id}>
                        <TableCell component="th" scope="row">{payment.Name}</TableCell>
                        <TableCell align="right">{payment.Data}</TableCell>
                        <TableCell align="right">{payment.Value}</TableCell>
                        <TableCell align="right">
                            <FiTrash className="cursorPointed" size={20} color="#c0392b" onClick={() => handleDeletePayment(payment.id)} />
                        </TableCell>
                      </TableRow>
                    )) : null 
                  }
                </TableBody>
              </Table>
            </TableContainer>
          </Grid>

          <Grid item xs={4}>
            <TableContainer className="tableContainer tableGrid">
              <h3 className="tableTitle">Recebimentos</h3>

              <Table stickyHeader aria-label="sticky table">
                <TableHead>
                  <TableRow>
                    <TableCell>Titulo</TableCell>
                    <TableCell align="right">Data</TableCell>
                    <TableCell align="right">Valor</TableCell>
                    <TableCell align="right">Deletar</TableCell>
                  </TableRow>
                </TableHead>
                <TableBody>
                  {incomes.length > 0 ? incomes.map((income) => (
                    <TableRow key={income.id}>
                      <TableCell component="th" scope="row">{income.Name}</TableCell>
                      <TableCell align="right">{income.Data}</TableCell>
                      <TableCell align="right">{income.Value}</TableCell>
                      <TableCell align="right">
                          <FiTrash className="cursorPointed" size={20} color="#c0392b" onClick={() => handleDeleteIncomes(income.id)} />
                      </TableCell>
                    </TableRow>
                  )) : null }
                </TableBody>
              </Table>

            </TableContainer>
          </Grid>
        </Grid>
      </Container>

      <Container maxWidth="xl">
        <Grid container>
          <Grid item xs={3}>
            <div className="totalBox">
              <p>Total: {totalIncome - totalPayment}</p>
            </div>
          </Grid>
          <Grid item xs={1}></Grid>
          <Grid item xs={4}>
            <p className="totalBox">Total a pagar: {totalPayment}</p>
          </Grid>
          <Grid item xs={4}>
            <p className="totalBox">Total a receber: {totalIncome}</p>

          </Grid>
        </Grid>
      </Container>

    </React.Fragment>
  );
}