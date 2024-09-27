import { motion } from "framer-motion";
import { styles } from "../styles";
import { ComputersCanvas } from "./canvas";
import {init} from 'ityped';
import React , { useEffect , useRef} from "react";
import {AiOutlineInstagram} from "react-icons/ai";
import { AiOutlineWhatsApp } from 'react-icons/ai';
import { AiOutlineFacebook } from 'react-icons/ai';
import {aarti} from "../assets";
import "./Hero.scss";

const Hero = () => {

  const textRef=useRef();
  useEffect(()=>
  {
    init(textRef.current, { showCursor: true, strings: [' Desarrollador Web ', "Tecnico Sistema ", " Aprendiz ", "Desarrollador Software "] })
  },[]);

  return (
    <section className={`relative w-full h-screen mx-auto`}>
      <div className="flex">
      <div
        className={`head1 absolute  max-w-7xl mx-auto ${styles.paddingX} flex flex-row items-start gap-5`}
      >
        <div className='flex flex-col justify-center items-center mt-5'>
          <div className='w-5 h-5 rounded-full bg-[#03C4EB]' />
          <div className='w-1 sm:h-80 h-40 bg-gradient-to-r from-blue-500 to-blue-300' />
        </div>


        <div className="head2">
          <h1 className={`${styles.heroHeadText} text-white`}>
            SystemX <p className='name text-[#03C4EB]'>FutureTech</p>
          </h1>
          <h3>
            <span ref={textRef} className={`${styles.heroSubText} mt-2 green-text-gradient`}></span>
          </h3>
        
        {/* cambiar los link */} 
        <div className="absolute link1">        
        <a
          href="https://api.whatsapp.com/send/?phone=573004755765&text&type=phone_number&app_absent=0" target="_blank">
          <AiOutlineWhatsApp />
        </a>
        <a
          href="https://www.instagram.com/systemx_218?igsh=MW5zM21hZmVrdHVlYg==" target="_blank">
          <AiOutlineInstagram />
        </a>
        <a 
          href="https://www.facebook.com/people/SystemX/61557114293325/?mibextid=ZbWKwL" target="_blank">
          <AiOutlineFacebook />
        </a>

      </div>

      </div>
      </div>
      <div className="imgcontainer1 absolute bg-gradient-to-r from-blue-500 to-blue-300">
        <img src={aarti} alt="" className="object-contain"/>
      </div>
      </div>


      <ComputersCanvas />

      <div className='absolute xs:bottom-10 bottom-32 w-10 flex justify-end items-center'>
        <a href='#education'>
          <div className='w-[35px] h-[64px] rounded-3xl border-4 border-secondary flex justify-center items-start p-2'>
            <motion.div
              animate={{
                y: [0, 24, 0],
              }}
              transition={{
                duration: 1.5,
                repeat: Infinity,
                repeatType: "loop",
              }}
              className='w-3 h-3 rounded-full bg-secondary mb-1'
            />
          </div>
        </a>
      </div>
    </section>
  );
};

export default Hero;