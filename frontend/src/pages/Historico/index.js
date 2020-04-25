import _ from 'lodash';
import React, { useState, useEffect } from 'react';
import Header from '../../components/Header'
import { Container, Typography, TableBody, Table, TableCell ,TableContainer, TableHead, TableRow, ExpansionPanel, ExpansionPanelSummary, ExpansionPanelDetails, Grid } from '@material-ui/core';
import { FiChevronDown, FiEye } from 'react-icons/fi';
import api from '../../services/api';
import './styles.css'

export default function Ano() { 
  const [token] = useState(localStorage.getItem('token'));
  const [detailIncome, setDetailIncome] = useState([]);
  const [detailPayment, setDetailPayment] = useState([]);
  const [arrayYears, setArrayYears] = useState([]);
  
  useEffect(() => {
    api.get('api/v1/months', {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      const groupByYear = _.groupBy(response.data.data, (month) => { return month.Ano })
      setArrayYears(groupByYear);
    })
  }, [token]);

  const detailMonth = (month) => {
    api.get(`api/v1/getMonth/payments/${month}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      setDetailPayment(response.data.data);
    })

    api.get(`api/v1/getMonth/income/${month}`, {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      setDetailIncome(response.data.data);
    })
  }

  return (
    <React.Fragment> 
      <Header />
      <Container maxWidth="xl">
        <Grid container>
          
          <Grid item xs={8}>
            <h3 className="tableTitle">Histórico de movimentações por Ano.</h3>
            {Object.keys(arrayYears).length > 0 ? Object.keys(arrayYears).map((year) =>
              (
                <ExpansionPanel key={year}>
                  {console.log(arrayYears[year])}
                  <ExpansionPanelSummary
                    expandIcon={<FiChevronDown />}
                    aria-controls="panel1a-content"
                    id="panel1a-header"
                  >
                    <Typography >Ano - {year}</Typography>
                  </ExpansionPanelSummary>
                  <ExpansionPanelDetails>
                  <TableContainer className="tableGrid">
                    <Table stickyHeader aria-label="sticky table">
                      <TableHead>
                        <TableRow>
                          <TableCell>#</TableCell>
                          <TableCell align="right">Data</TableCell>
                          <TableCell align="right">Pagamentos</TableCell>
                          <TableCell align="right">Recebimentos</TableCell>
                          <TableCell align="right">Total</TableCell>
                          <TableCell align="right">Detalhar</TableCell>
                          <TableCell align="right">Status</TableCell>
                        </TableRow>
                      </TableHead>
                      <TableBody>

                        {arrayYears[year].length > 0 ? arrayYears[year].map((month) => 
                          (
                            <TableRow key={month.id}>
                              <TableCell component="th" scope="row">{month.id}</TableCell>
                              <TableCell align="right">{month.Data}</TableCell>
                              <TableCell align="right">{month.Paid}</TableCell>
                              <TableCell align="right">{month.Received}</TableCell>
                              <TableCell align="right" className={month.Total <= 0 ? 'mesNegativo' : 'mesPositivo'}>{month.Total}</TableCell>
                              <TableCell align="right"><FiEye onClick={() => detailMonth(month.id)} className="cursorPointed" size={20} color="#333" style={{ fontWeight : 500 }} /></TableCell>
                              <TableCell align="right">
                                  {
                                    month.Status === 'fechado' ? 
                                    (
                                      <React.Fragment> 
                                        <span className='mesFechado' style={{color: '#333333' }}>
                                          Mês Fechado
                                        </span>
                                      </React.Fragment>
                                    ) : (
                                      <React.Fragment>
                                        <span className='fecharMesButton' style={{color: '#333333', cursor: 'default' }}>
                                          Mês Aberto
                                        </span>
                                      </React.Fragment>
                                    )
                                  }
                              </TableCell>
                            </TableRow>
                          )) : null 
                        }
                      </TableBody>
                    </Table>
                    </TableContainer>
                  </ExpansionPanelDetails>
                </ExpansionPanel>
              )) : null
            }
          </Grid>

          <Grid item xs={4}>
            {
              detailIncome.length > 0 && detailPayment.length > 0 ? (
                <React.Fragment>
                  <TableContainer className="tableContainer tableGrid" style={{ marginLeft: '10%' }}>

                    <h3 className="tableTitle">Pagamentos</h3>
                    <Table stickyHeader aria-label="sticky table">
                      <TableHead>
                        <TableRow>
                          <TableCell>Titulo</TableCell>
                          <TableCell align="right">Data</TableCell>
                          <TableCell align="right">Valor</TableCell>
                        </TableRow>
                      </TableHead>
                      <TableBody>
                        {detailPayment.length > 0 ? detailPayment.map((payment) => 
                          (
                            <TableRow key={payment.id}>
                              <TableCell component="th" scope="row">{payment.Name}</TableCell>
                              <TableCell align="right">{payment.Data}</TableCell>
                              <TableCell align="right">{payment.Value}</TableCell>
                            </TableRow>
                          )) : null 
                        }
                      </TableBody>
                    </Table>
                  </TableContainer>

                  <TableContainer className="tableContainer tableGrid" style={{ marginLeft: '10%' }}>

                    <h3 className="tableTitle">Recebimentos</h3>
                    <Table stickyHeader aria-label="sticky table">
                      <TableHead>
                        <TableRow>
                          <TableCell>Titulo</TableCell>
                          <TableCell align="right">Data</TableCell>
                          <TableCell align="right">Valor</TableCell>
                        </TableRow>
                      </TableHead>
                      <TableBody>
                        {detailIncome.length > 0 ? detailIncome.map((income) => 
                          (
                            <TableRow key={income.id}>
                              <TableCell component="th" scope="row">{income.Name}</TableCell>
                              <TableCell align="right">{income.Data}</TableCell>
                              <TableCell align="right">{income.Value}</TableCell>
                            </TableRow>
                          )) : null 
                        }
                      </TableBody>
                    </Table>
                  </TableContainer>
                </React.Fragment>
              ) : null
            }
          </Grid>
        </Grid>
      </Container>
    </React.Fragment>
  );
}