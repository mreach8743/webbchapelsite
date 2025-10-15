import React from 'react';
import { Link } from 'react-router-dom';
import { ChevronDown, Menu } from 'lucide-react';

const Header: React.FC = () => {
  return (
    <>
      {/* Contact Bar */}
      <div className="w-full text-center church-blue text-white font-bold py-2">
        13425 Webb Chapel Road, Farmers Branch, Texas 75234&nbsp;&nbsp;|&nbsp;&nbsp;(972) 241-3293
      </div>

      {/* Main Header */}
      <header className="bg-white shadow-md h-32 flex items-center">
        <div className="container mx-auto px-4">
          <div className="flex items-center justify-between">
            {/* Left Navigation */}
            <nav className="flex items-center space-x-6">
              <Link 
                to="/" 
                className="text-gray-800 hover:text-church-blue font-semibold transition-colors"
              >
                HOME
              </Link>
              
              {/* Leadership Dropdown */}
              <div className="relative group">
                <button className="flex items-center text-gray-800 hover:text-church-blue font-semibold transition-colors">
                  LEADERSHIP
                  <ChevronDown className="ml-1 h-4 w-4" />
                </button>
                <div className="absolute top-full left-0 mt-1 w-48 bg-white shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                  <Link 
                    to="/elders" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    SHEPHERDS
                  </Link>
                  <Link 
                    to="/deacons" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    DEACONS
                  </Link>
                  <Link 
                    to="/ministers" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    MINISTERS
                  </Link>
                  <Link 
                    to="/staff" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    STAFF
                  </Link>
                </div>
              </div>

              <Link 
                to="/livestreaming" 
                className="text-gray-800 hover:text-church-blue font-semibold transition-colors"
              >
                LIVESTREAM
              </Link>
              
              <Link 
                to="/sitb" 
                className="text-gray-800 hover:text-church-blue font-semibold transition-colors"
              >
                SITB
              </Link>
            </nav>

            {/* Logo */}
            <div className="flex-shrink-0">
              <Link to="/">
                <img 
                  src="/src/assets/images/logo.png" 
                  alt="Webb Chapel church of Christ" 
                  className="h-20 w-auto"
                />
              </Link>
            </div>

            {/* Right Navigation */}
            <nav className="flex items-center space-x-6">
              <Link 
                to="/smallgroups" 
                className="text-gray-800 hover:text-church-blue font-semibold transition-colors"
              >
                SMALL GROUPS
              </Link>
              
              {/* Members Dropdown */}
              <div className="relative group">
                <button className="flex items-center text-gray-800 hover:text-church-blue font-semibold transition-colors">
                  MEMBERS
                  <ChevronDown className="ml-1 h-4 w-4" />
                </button>
                <div className="absolute top-full left-0 mt-1 w-48 bg-white shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                  <Link 
                    to="/calendar" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    CALENDAR
                  </Link>
                  <Link 
                    to="/giving" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    GIVING
                  </Link>
                  <Link 
                    to="/summerlearningcamp" 
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    SUMMER CAMP
                  </Link>
                  <a 
                    href="https://onrealm.org/WebbChapelChurch" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    className="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                  >
                    REALM LOGIN
                  </a>
                </div>
              </div>

              <Link 
                to="/contact" 
                className="text-gray-800 hover:text-church-blue font-semibold transition-colors"
              >
                CONTACT
              </Link>
            </nav>

            {/* Mobile Menu Button */}
            <button className="md:hidden p-2">
              <Menu className="h-6 w-6" />
            </button>
          </div>
        </div>
      </header>
    </>
  );
};

export default Header;
