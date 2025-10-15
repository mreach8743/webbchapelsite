import React from 'react';
import { MapPin, Phone, Mail, Clock } from 'lucide-react';
import CognitoForm from '../components/CognitoForm';

const ContactPage: React.FC = () => {
  return (
    <div className="w-full">
      {/* Google Maps Embed */}
      <div className="w-full h-96 mb-8">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3348.847942046478!2d-96.87624268434288!3d32.92861548092659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864c2706c730337d%3A0xc22385d7f5df5c60!2sWebb+Chapel+Church+of+Christ!5e0!3m2!1sen!2sus!4v1504245714174" 
          width="100%" 
          height="100%" 
          style={{ border: 0 }}
          allowFullScreen
          loading="lazy"
          referrerPolicy="no-referrer-when-downgrade"
          className="rounded-lg shadow-lg"
        />
      </div>

      <div className="py-16">
        <div className="container mx-auto px-4">
          <h1 className="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
            CONTACT US
          </h1>
          
          <div className="max-w-4xl mx-auto">
            {/* Contact Information */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
              <div className="bg-white rounded-lg shadow-lg p-6">
                <h2 className="text-2xl font-bold text-gray-800 mb-6">Get In Touch</h2>
                
                <div className="space-y-4">
                  <div className="flex items-start">
                    <MapPin className="h-6 w-6 text-church-blue mt-1 mr-3 flex-shrink-0" />
                    <div>
                      <h3 className="font-semibold text-gray-800">Address</h3>
                      <p className="text-gray-600">
                        13425 Webb Chapel Road<br />
                        Farmers Branch, Texas 75234
                      </p>
                    </div>
                  </div>
                  
                  <div className="flex items-center">
                    <Phone className="h-6 w-6 text-church-blue mr-3 flex-shrink-0" />
                    <div>
                      <h3 className="font-semibold text-gray-800">Phone</h3>
                      <p className="text-gray-600">(972) 241-3293</p>
                    </div>
                  </div>
                  
                  <div className="flex items-center">
                    <Mail className="h-6 w-6 text-church-blue mr-3 flex-shrink-0" />
                    <div>
                      <h3 className="font-semibold text-gray-800">Email</h3>
                      <p className="text-gray-600">info@webbchapel.org</p>
                    </div>
                  </div>
                </div>
              </div>
              
              <div className="bg-white rounded-lg shadow-lg p-6">
                <h2 className="text-2xl font-bold text-gray-800 mb-6">Service Times</h2>
                
                <div className="space-y-4">
                  <div className="flex items-start">
                    <Clock className="h-6 w-6 text-church-blue mt-1 mr-3 flex-shrink-0" />
                    <div>
                      <h3 className="font-semibold text-gray-800">Sunday Morning</h3>
                      <p className="text-gray-600">
                        9:30 AM - Worship<br />
                        11:00 AM - Bible Classes
                      </p>
                    </div>
                  </div>
                  
                  <div className="flex items-start">
                    <Clock className="h-6 w-6 text-church-blue mt-1 mr-3 flex-shrink-0" />
                    <div>
                      <h3 className="font-semibold text-gray-800">Sunday Evening</h3>
                      <p className="text-gray-600">
                        Small Group Meetings<br />
                        Contact church office
                      </p>
                    </div>
                  </div>
                  
                  <div className="flex items-start">
                    <Clock className="h-6 w-6 text-church-blue mt-1 mr-3 flex-shrink-0" />
                    <div>
                      <h3 className="font-semibold text-gray-800">Wednesday Evening</h3>
                      <p className="text-gray-600">
                        7:00 PM - Bible Study
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            {/* Contact Form */}
            <div className="bg-white rounded-lg shadow-lg p-8">
              <h2 className="text-2xl font-bold text-gray-800 mb-6 text-center">
                Send Us a Message
              </h2>
              
              <div className="bg-gray-50 rounded-lg p-6">
                <CognitoForm 
                  dataKey="V3ZbR_hZIEKuz9M3qRqiEA"
                  dataForm="93"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ContactPage;
