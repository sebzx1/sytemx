import React from "react";
import { useEffect, useState } from "react";
import "./Footer.scss";

const Footer = () => {

    return (
        <div className="footer text-center">
        <p> 
          &#x3c;&#47;&#x3e; Copyright © 2014, todos los derechos reservados.
          <a href="https://api.whatsapp.com/send/?phone=573004755765&text&type=phone_number&app_absent=0" target="_blank">
            {" "}
            SytemX
          </a>
          😎
        </p>
        <p className="pink-text-gradient">No. de Visitantes | <img className="visitcounter" src="https://hitwebcounter.com/counter/counter.php?page=9795911&style=0025&nbdigits=5&type=page&initCount=459" title="Counter Widget" Alt="Visit counter For Websites"   border="0" /></p>

      </div>
    );
  };
  
  export default Footer;