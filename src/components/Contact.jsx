 import React, { useRef, useState } from "react";
import { motion } from "framer-motion";
import emailjs from "@emailjs/browser";

import { styles } from "../styles";
import { EarthCanvas } from "./canvas";
import { SectionWrapper } from "../hoc";
import { slideIn } from "../utils/motion";
import { MdEmail } from "react-icons/md";
import { BsWhatsapp } from "react-icons/bs";
import "./Contact.scss";

const Contact = () => {
  const formRef = useRef();
  const [form, setForm] = useState({
    name: "",
    email: "",
    message: "",
  });

  const [loading, setLoading] = useState(false);

  const handleChange = (e) => {
    const { target } = e;
    const { name, value } = target;

    setForm({
      ...form,
      [name]: value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    // Validación de formulario
    if (!form.name || !form.email || !form.message) {
      alert("Por favor, completa todos los campos.");
      return;
    }

    setLoading(true);

    try {
      await emailjs.send(
        'service_p20a7el',
        'template_8drkznw',
        {
          from_name: form.name,  // Esta variable se usa en la plantilla
          to_name: "SystemX",    // Esta variable se usa en la plantilla
          from_email: form.email, // Puedes quitarlo si no es necesario en la plantilla
          message: form.message,  // Esta variable se usa en la plantilla
        },
        'yxUkSHN5OA28tTCpI',
      );

      alert("Gracias. Me comunicaré contigo lo antes posible.");
      setForm({
        name: "",
        email: "",
        message: "",
      });
    } catch (error) {
      console.error(error);
      alert("Algo salió mal. Por favor inténtalo de nuevo.");
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className={`xl:mt-12 flex xl:flex-row flex-col gap-10 overflow-hidden`}>
      <motion.div
        variants={slideIn("left", "tween", 0.2, 1)}
        className='xl:flex-1 xl:h-auto md:h-[550px] h-[350px]'
      >
        <EarthCanvas />
      </motion.div>

      <motion.div 
        whileInView={{ opacity: 1, transform: 'none' }}
        variants={slideIn("right", "tween", 0.2, 1)}
        className='flex-[0.75] bg-black-100 p-8 rounded-2xl'
      >
        <p className={styles.sectionSubText}>Ponte en contacto</p>
        <h3 className={styles.sectionHeadText}>Contacto</h3>

        <form
          ref={formRef}
          onSubmit={handleSubmit}
          className='mt-3 flex flex-col gap-8'
        >
          <label className='flex flex-col' htmlFor='name'>
            <span className='text-white font-medium mb-3'>Nombre</span>
            <input
              id='name'
              type='text'
              name='name'
              value={form.name}
              onChange={handleChange}
              placeholder="Cual es tu nombre?"
              className='bg-tertiary py-3 px-3 placeholder:text-secondary text-white rounded-lg border-none font-medium'
            />
          </label>
          <label className='flex flex-col' htmlFor='email'>
            <span className='text-white font-medium mb-3'>Correo Electrónico</span>
            <input
              id='email'
              type='email'
              name='email'
              value={form.email}
              onChange={handleChange}
              placeholder="Cual es tu correo?"
              className='bg-tertiary py-3 px-3 placeholder:text-secondary text-white rounded-lg border-none font-medium'
            />
          </label>
          <label className='flex flex-col' htmlFor='message'>
            <span className='text-white font-medium mb-3'>Mensaje</span>
            <textarea
              id='message'
              rows={7}
              name='message'
              value={form.message}
              onChange={handleChange}
              placeholder='Que quiere escribir?'
              className='bg-tertiary py-3 px-3 placeholder:text-secondary text-white rounded-lg border-none font-medium'
            />
          </label>

          <button
            type='submit'
            className='bg-tertiary py-3 px-5 rounded-xl outline-none w-fit text-white font-bold shadow-md shadow-primary'
          >
            {loading ? "Sending..." : "Enviar"}
          </button>
        </form>

        <div className="mt-5 contact__options">
          <article className="contact__option">
            <MdEmail />
            <a href="mailto:systemx218@gmail.com" target="_blank" rel="noopener noreferrer" className="blue-text-gradient">systemx218@gmail.com</a>
          </article>
          <article className="contact__option">
            <BsWhatsapp />
            <a href="https://api.whatsapp.com/send/?phone=573004755765&text&type=phone_number&app_absent=0" target="_blank" rel="noopener noreferrer" className="blue-text-gradient">
              +57 3004755765
            </a>
          </article>
        </div>
      </motion.div>
    </div>
  );
};

export default SectionWrapper(Contact, "contact");
