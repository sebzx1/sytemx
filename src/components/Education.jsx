import React from "react";
import { motion } from "framer-motion";

import { styles } from "../styles";
import { SectionWrapper } from "../hoc";
import { fadeIn, textVariant } from "../utils/motion";
import "./Education.scss";

const FeedbackCard = ({
  index,
  branch,
  marks,
  name,
  degree,
  year,
  image,
}) => (
  <motion.div
    variants={fadeIn("", "spring", index * 0.5, 0.75)}
    className='Box2 p-5 rounded-3xl xs:w-[320px] w-full'
  >
    <div className='mt-7 flex flex-col justify-between items-center gap-1'>
      <img
        src={image}
        alt={`feedback_by-${name}`}
        width="80" height="80"
        className='rounded-full object-cover'
      />
      <div className='mt-3 flex-1 flex flex-col'>
        <p className='text-center text-white font-medium text-[16px]'>
          <span className='text-center blue-text-gradient'>{name}</span>
        </p>
        <p className='text-center mt-1 text-secondary text-[12px]'>
          {year}
        </p>
      </div>

    </div>

    <p className='text-white font-black text-[48px]'>"</p>

    <div className='mt-1'>
      <p className='text-center text-white tracking-wider text-[18px]'>{degree}</p>
      <p className='mt-3 text-center pink-text-gradient'>{branch}</p>
      <p className='mt-3 text-center green-text-gradient'>{marks}</p>

    </div>
  </motion.div>
);

const Education = () => {
  return (
    <div className={`mt-12 bg-black-100 rounded-[20px]`}>
      <div
        className={`bg-tertiary rounded-2xl ${styles.padding} min-h-[300px]`}
      >
        <motion.div variants={textVariant()}>
          <h2 className={`${styles.sectionHeadText} text-center`}>NOSOTROS</h2>
          <p className={`${styles.sectionSubText} text-justify`}>Bienvenido a SystemX, tu socio de confianza en soluciones tecnológicas. Nos especializamos en ofrecer servicios técnicos en sistemas, garantizando que tu infraestructura tecnológica funcione de manera óptima y sin interrupciones. Nuestro equipo de expertos está siempre listo para resolver cualquier problema técnico que puedas enfrentar, asegurando que tu negocio opere sin contratiempos.

            Además, en SystemX, nos dedicamos a la creación y desarrollo de páginas web atractivas y funcionales. Entendemos la importancia de tener una presencia online efectiva, por lo que diseñamos sitios web a medida que no solo capturan la esencia de tu marca, sino que también proporcionan una experiencia de usuario excepcional. Ya sea que necesites una página web sencilla o una plataforma compleja, estamos aquí para hacer realidad tu visión digital.

            Para completar nuestra oferta, te brindamos soluciones de marketing digital diseñadas para aumentar tu visibilidad y atraer a tu público objetivo. Desde campañas en redes sociales hasta estrategias de SEO y publicidad en línea, nuestro enfoque integral asegura que tu mensaje llegue a las personas correctas en el momento adecuado. En SystemX, estamos comprometidos en ayudarte a crecer y destacarte en el competitivo mundo digital.</p>
        </motion.div>
      </div>
    </div>
  );
};

export default SectionWrapper(Education, "education");