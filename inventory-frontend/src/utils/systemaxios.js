import axios from 'axios';
import config from "./config";

const baseClient = axios.create( {
    baseURL: config.inventoryAPIHost,
    header:{
        "Accept":"application/json",
        "Content-type":"application/json",
        "X-Requestd-With":"XMLHttpRequest"
    }
})

const inventoryAxiosClient = axios.create( {
    baseURL: config.inventoryAPIHost +'/api',
    header:{
        "Accept":"application/json",
        "Content-type":"application/json",
        "X-Requested-With":"XMLHttpRequest"
    },
    "Autharization":"Bearer"+config.apiToken
})

export{
    baseClient,
    inventoryAxiosClient
}