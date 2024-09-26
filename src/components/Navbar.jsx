import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";

import { styles } from "../styles";
import { logo } from "../assets";
import "./Navbar.scss";

const Navbar = () => {
  const [active, setActive] = useState("");
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      const scrollTop = window.scrollY;
      if (scrollTop > 100) {
        setScrolled(true);
      } else {
        setScrolled(false);
      }
    };

    window.addEventListener("scroll", handleScroll);

    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  return (
    <nav
      className={`${styles.paddingX
        } w-full flex items-center py-3 fixed top-0 z-20 ${scrolled ? "bg-primary" : "bg-transparent"
        }`}
    >
      <div className='w-full flex justify-between items-center max-w-7xl mx-auto'>
        <Link
          to='/'
          className='flex items-center gap-2'
          onClick={() => {
            setActive("");
            window.scrollTo(0, 0);
          }}
        >
          <img src={logo} alt='logo' className='w-9 h-9 object-contain logo' />
          <a
            href='http://localhost/systemx/php/inicio.php'
            className='sm:block text-white text-[18px] font-bold cursor-pointer flex'
            onClick={(e) => {
              e.stopPropagation(); // Evita que el clic cierre la acción del Link
            }}
          >
            SystemX
          </a>
        </Link>

        <div className='sm:flex gap-5'>
          <div
            className={`top2 ${"text-secondary"
              } hover:text-white text-[15px] font-medium cursor-pointer`}
          >
          </div>
        </div>
      </div>
    </nav>
  )
}

export default Navbar