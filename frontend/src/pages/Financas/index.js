import React, { useState, useEffect } from 'react';
import Header from '../../components/Header'
import Container from '@material-ui/core/Container';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import TextField from '@material-ui/core/TextField';
import { makeStyles } from '@material-ui/core/styles';
import Grid from '@material-ui/core/Grid';
import api from '../../services/api';
import './styles.css';

const useStyles = makeStyles((theme) => ({
  root: {
    flexGrow: 1,
  },
  paper: {
    padding: theme.spacing(2),
    textAlign: 'center',
    color: theme.palette.text.secondary,
  },
}));

export default function Financas() {
  const [payments, setPayments] = useState([]);
  const [incomes, setIncomes] = useState([]);
  const [paymentName, setPaymentName] = useState([]);
  const [paymentValue, setPaymentValue] = useState([]);
  const [paymentDate, setPaymentDate] = useState([]);
  const [paymentComment, setPaymentComment] = useState([]);
  const [token] = useState(localStorage.getItem('token'));
  
  const classes = useStyles();

  useEffect(() => {
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
  }, []);

  return (
    <React.Fragment>
      <Header />
      <Container maxWidth="xl">
        <Grid container>
          <Grid item xs={3} spacing={4}>
            <div className="form">
              <strong>Cadastrar Pagamento</strong>
              <form noValidate autoComplete="off">
                <TextField 
                  name="paymentName" 
                  id="paymentName" 
                  label="Nome da Empresa"
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
            </div>
          </Grid>
          
          <Grid item xs={3}>
            <TableContainer className="tableContainer">

              <h3 className="tableTitle">Pagamentos</h3>
              <Table aria-label="simple table">
                <TableHead>
                  <TableRow>
                    <TableCell>Titulo</TableCell>
                    <TableCell align="right">Data</TableCell>
                    <TableCell align="right">Valor</TableCell>
                  </TableRow>
                </TableHead>
                <TableBody>
                  {payments.length > 0 ? payments.map((payment) => (
                    <TableRow key={payment.ID}>
                      <TableCell component="th" scope="row">{payment.Name}</TableCell>
                      <TableCell align="right">{payment.Data}</TableCell>
                      <TableCell align="right">{payment.Value}</TableCell>
                    </TableRow>
                  )) : null }
                </TableBody>
              </Table>
            </TableContainer>
          </Grid>

          <Grid item xs={3}>
            <TableContainer className="tableContainer">
              <h3 className="tableTitle">Recebimentos</h3>

              <Table className={classes.table} aria-label="simple table">
                <TableHead>
                  <TableRow>
                    <TableCell>Titulo</TableCell>
                    <TableCell align="right">Data</TableCell>
                    <TableCell align="right">Valor</TableCell>
                  </TableRow>
                </TableHead>
                <TableBody>
                  {incomes.length > 0 ? incomes.map((income) => (
                    <TableRow key={income.ID}>
                      <TableCell component="th" scope="row">{income.Name}</TableCell>
                      <TableCell align="right">{income.Data}</TableCell>
                      <TableCell align="right">{income.Value}</TableCell>
                    </TableRow>
                  )) : null }
                </TableBody>
              </Table>

            </TableContainer>
          </Grid>
          <Grid item xs={4}>
          
          </Grid>
        </Grid>
      </Container>
    </React.Fragment>
  );
}