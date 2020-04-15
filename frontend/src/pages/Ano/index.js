import React, { useState, useEffect } from 'react';
import Header from '../../components/Header'
import { Container, TableBody, Table, TableCell ,TableContainer, TableHead, TableRow, TextField, Grid } from '@material-ui/core';
import { FiCheckSquare, FiSquare } from 'react-icons/fi';
import api from '../../services/api';
import './styles.css'

export default function Ano() { 
  const [token] = useState(localStorage.getItem('token'));
  const [months, setMonths] = useState([]);
  const [totais, setTotais] = useState({});
  

  useEffect(() => {
    api.get('api/v1/currentYear', {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      setMonths(response.data.data);
    })
  }, [token]);

  useEffect(() => {
    if(months.length > 0){
      let data = {
        pagamentos:0,
        recebimentos:0,
        total:0
      };

      months.map((month) => {
        data.pagamentos += parseInt(month.Paid);
        data.recebimentos += parseInt(month.Received);
        data.total+= parseInt(month.Total);

        return data;
      })

      setTotais(data);
    }
  }, [months]);

  const closeThisMonth = (month) =>{
    api.put(`api/v1/closeOtherMonth/${month}`, {}, {
      headers: {
        Authorization: `Bearer ${token}`,
      }
    }).then(response => {
      const filteredMonth = months.filter( function(elem) {
        return elem.id !== response.data.data.id;
      });
      setMonths([...filteredMonth, response.data.data]);
    }).catch(err => {
      console.log(err);
    })
  }

  return (
    <React.Fragment> 
      <Header />
      <Container maxWidth="xl">
        <Grid container>
          
          <Grid item xs={9}>
          <span className='fecharMesButton'>* Pagamentos, Recebimentos e Total só estão disponiveis após o mês ser fechado.</span>
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

                  {months.length > 0 ? months.map((month) => 
                    (
                      <TableRow key={month.id}>
                        <TableCell component="th" scope="row">{month.id}</TableCell>
                        <TableCell align="right">{month.Data}</TableCell>
                        <TableCell align="right">{month.Paid}</TableCell>
                        <TableCell align="right">{month.Received}</TableCell>
                        <TableCell align="right" className={month.Total <= 0 ? 'mesNegativo' : 'mesPositivo'}>{month.Total}</TableCell>
                        <TableCell align="right">Detalhar</TableCell>
                        <TableCell align="right">
                            {
                              month.Status === 'fechado' ? 
                              (
                                <React.Fragment> 
                                  <FiCheckSquare className="cursorPointed" size={20} color="#16a085" />
                                  <span className='mesFechado'>
                                    Mês Fechado
                                  </span>
                                </React.Fragment>
                              ) : (
                                <a onClick={()=>closeThisMonth(month.id)}>
                                  <FiSquare className="cursorPointed" size={20} color="#c0392b" />
                                  <span className='fecharMesButton'>
                                    Fechar mês
                                  </span>
                                </a>
                              )
                            }
                        </TableCell>
                      </TableRow>
                     )) : null 
                   }
                </TableBody>
                <TableRow className="tableFooter">
                  <TableCell>Total</TableCell>
                  <TableCell align="right"></TableCell>
                  <TableCell align="right">{totais.pagamentos}</TableCell>
                  <TableCell align="right">{totais.recebimentos}</TableCell>
                  <TableCell align="right" className={totais.total <= 0 ? 'mesNegativo' : 'mesPositivo'}>{totais.total}</TableCell>
                  <TableCell align="right"></TableCell>
                  <TableCell align="right"></TableCell>
                </TableRow>
              </Table>
            </TableContainer>
          </Grid>
        </Grid>
      </Container>
    </React.Fragment>
  );
}