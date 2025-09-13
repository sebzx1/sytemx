import React from "react";
import { motion } from "framer-motion";

import { styles } from "../styles";
import { SectionWrapper } from "../hoc";
import { fadeIn, textVariant } from "../utils/motion";
import { achievements } from "../constants";
import "./Achievement.scss";

const Achievement = () => {
  return (
    <div className={`mt-12 bg-black-100 rounded-[20px]`}>
      <div
        className={`bg-tertiary rounded-2xl ${styles.padding}`}
      >
        <motion.div variants={textVariant()}>
          <p className={`${styles.sectionSubText} text-center`}>Follow us</p>
          <h2 className={`${styles.sectionHeadText} text-center`} >Siguenos para obtener mas actualizaciones</h2>
        </motion.div>
      </div>
      <div className={`-mt-20 justify-center p-6 ${styles.paddingX} gap-7`}>
        <ul className='mt-5 list-disc ml-5 space-y-2'>
          {achievements.map((achievement, index) => (
            <li key={`achievement-${index}`} className='text-white-100 text-[15px] pl-1'>{achievement.title}</li>
          ))}
        </ul>
      </div>

      <button className="btn btn-primary btn-lg ml-6 mb-10" style={{ borderRadius: '25px', padding: '10px 20px' }}>
        <a
          href="https://www.facebook.com/people/SystemX/61557114293325/?mibextid=ZbWKwL"
          target="_blank"
          rel="noopener noreferrer"
          className="btn btn-primary btn-lg"
        >
          ¡Síguenos en Facebook!
        </a>

        </button>

    </div>
  );
};

export default SectionWrapper(Achievement, "achievements");