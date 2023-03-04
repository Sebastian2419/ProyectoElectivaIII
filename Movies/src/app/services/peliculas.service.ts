import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, of } from 'rxjs';
import { catchError, map, tap } from 'rxjs/operators';
import { Cast, Credits } from '../interfaces/credits.interface';
import { MovieDetails } from '../interfaces/pelicula.interface';
import { Movie, PeliculasResponse } from '../interfaces/peliculas.interface';

@Injectable({
  providedIn: 'root'
})
export class PeliculasService {


  private serverURL: string = 'https://api.themoviedb.org/3';
  private peliculaPage = 1;
  cargando = false;

  constructor(private http:HttpClient) {}


  get params(){
      return{
        api_key : 'e89ce3d831c7fbe0e58b0b3be66bcf4a',
        language : 'es-ES',
        page:this.peliculaPage.toString()
      }
  }

  getPeliculas():Observable<Movie[]>{
    
    if (this.cargando){
      
      return of([]);

    }
    
    this.cargando = true;
    
    console.log('Peliculas cargadas')

    return this.http.get<PeliculasResponse>(`${this.serverURL}/movie/now_playing`,{params:this.params}).pipe(

      map((res)=>res.results),
      tap(()=>{
        this.peliculaPage+=1;
        this.cargando=false;
      })
    ); 
  }

  
  getPeliculaDetalle(id:string){

    return this.http.get< MovieDetails>(`${this.serverURL}/movie/${id}`,{
      params:this.params
    }).pipe(
  
      catchError(err => of(null))
  
    )
  }
  


  buscarPeliculas(texto:string):Observable<Movie[]>{

    /*   https://api.themoviedb.org/3/search/movie?api_key=13ee2b3b1810d881d34a3d2f4351f448&language=es-ES&page=1&include_adult=false
     */
      const params = {...this.params, page:1, query:texto};
    
      return this.http.get<PeliculasResponse>(`${this.serverURL}/search/movie`,{
        params
      }).pipe(
        map(res=>res.results)
      )
    
    
    } 
    
  getCast(id:string):Observable<Cast[]>{

      return this.http.get<Credits>(`${this.serverURL}/movie/${id}/credits`,{
        params:this.params
      }).pipe(
        map(res=> res.cast),
        catchError(err => of([]))
      );
    
    }


  resetPeliculaPage(){
    this.peliculaPage = 1;
  }

}
