import React from 'react';
import { Users, DollarSign, Phone, Mail } from 'lucide-react';

const StaffPage: React.FC = () => {
  const staff = [
    {
      name: "Maricela Obiedo",
      title: "Financial Secretary",
      image: "/images/leadership/staff/staff-maricelaobiedo.jpg",
      bio: "Maricela handles the financial operations and administrative tasks for our church. She ensures that all financial matters are handled with integrity and transparency.",
      responsibilities: [
        "Financial record keeping",
        "Budget management",
        "Administrative support",
        "Office coordination"
      ]
    },
    {
      name: "Carolyn Fisher",
      title: "Administrative Assistant",
      image: "/images/leadership/staff/staff-carolynfisher.jpg",
      bio: "Carolyn provides essential administrative support to our church operations, helping to keep everything running smoothly.",
      responsibilities: [
        "Office administration",
        "Event coordination",
        "Member communication",
        "General support"
      ]
    }
  ];

  return (
    <div className="w-full">
      {/* Hero Section */}
      <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white py-16">
        <div className="container mx-auto px-4">
          <div className="text-center">
            <h1 className="text-4xl md:text-5xl font-bold mb-4">
              Our Staff
            </h1>
            <p className="text-xl md:text-2xl text-blue-100">
              Dedicated professionals supporting our church operations
            </p>
          </div>
        </div>
      </div>

      <div className="container mx-auto px-4 py-12">
        {/* Introduction */}
        <div className="max-w-4xl mx-auto mb-12">
          <div className="bg-white rounded-lg shadow-lg p-8">
            <div className="text-center mb-8">
              <Users className="w-16 h-16 text-church-blue mx-auto mb-4" />
              <h2 className="text-3xl font-bold text-gray-800 mb-4">
                Meet Our Staff
              </h2>
              <p className="text-lg text-gray-600">
                Our staff members are dedicated professionals who handle the day-to-day operations of our church. 
                They work behind the scenes to ensure that everything runs smoothly, from financial management 
                to administrative support and member services.
              </p>
            </div>
          </div>
        </div>

        {/* Staff Grid */}
        <div className="grid md:grid-cols-2 gap-8 mb-12">
          {staff.map((member, index) => (
            <div key={index} className="bg-white rounded-lg shadow-lg overflow-hidden">
              <div className="p-6">
                <div className="text-center mb-6">
                  <img 
                    src={member.image} 
                    alt={member.name}
                    className="w-48 h-60 object-cover rounded-lg mx-auto mb-4"
                  />
                  <h3 className="text-2xl font-bold text-gray-800 mb-2">
                    {member.name}
                  </h3>
                  <p className="text-church-blue font-semibold text-lg mb-4">
                    {member.title}
                  </p>
                </div>
                
                <div className="space-y-4">
                  <div>
                    <h4 className="font-semibold text-gray-800 mb-2">About</h4>
                    <p className="text-gray-600 leading-relaxed">
                      {member.bio}
                    </p>
                  </div>
                  
                  <div>
                    <h4 className="font-semibold text-gray-800 mb-2">Responsibilities</h4>
                    <ul className="space-y-1">
                      {member.responsibilities.map((responsibility, idx) => (
                        <li key={idx} className="flex items-start">
                          <span className="w-2 h-2 bg-church-blue rounded-full mt-2 mr-3 flex-shrink-0"></span>
                          <span className="text-gray-600">{responsibility}</span>
                        </li>
                      ))}
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>

        {/* Office Information */}
        <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white rounded-lg p-8 mb-12">
          <h2 className="text-3xl font-bold text-center mb-8">
            Office Information
          </h2>
          
          <div className="grid md:grid-cols-2 gap-8">
            <div>
              <h3 className="text-xl font-bold mb-4">Office Hours</h3>
              <div className="space-y-2 text-blue-100">
                <p>Monday - Friday: 9:00 AM - 5:00 PM</p>
                <p>Saturday: 9:00 AM - 12:00 PM</p>
                <p>Sunday: Closed</p>
              </div>
            </div>
            
            <div>
              <h3 className="text-xl font-bold mb-4">Contact Information</h3>
              <div className="space-y-2 text-blue-100">
                <p className="flex items-center">
                  <Phone className="w-4 h-4 mr-2" />
                  (972) 241-3293
                </p>
                <p className="flex items-center">
                  <Mail className="w-4 h-4 mr-2" />
                  office@webbchapel.org
                </p>
              </div>
            </div>
          </div>
        </div>

        {/* Services Provided */}
        <div className="bg-white rounded-lg shadow-lg p-8 mb-12">
          <h2 className="text-2xl font-bold text-gray-800 mb-6 text-center">
            Services We Provide
          </h2>
          
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div className="text-center">
              <DollarSign className="w-12 h-12 text-church-blue mx-auto mb-4" />
              <h3 className="text-lg font-bold text-gray-800 mb-2">Financial Services</h3>
              <p className="text-gray-600">
                Budget management, financial reporting, and donation processing
              </p>
            </div>
            
            <div className="text-center">
              <Users className="w-12 h-12 text-church-blue mx-auto mb-4" />
              <h3 className="text-lg font-bold text-gray-800 mb-2">Member Services</h3>
              <p className="text-gray-600">
                Membership records, directory updates, and member communication
              </p>
            </div>
            
            <div className="text-center">
              <Phone className="w-12 h-12 text-church-blue mx-auto mb-4" />
              <h3 className="text-lg font-bold text-gray-800 mb-2">Administrative Support</h3>
              <p className="text-gray-600">
                Office management, event coordination, and general support
              </p>
            </div>
          </div>
        </div>

        {/* Contact Information */}
        <div className="bg-white rounded-lg shadow-lg p-8">
          <h2 className="text-2xl font-bold text-gray-800 mb-6 text-center">
            Need Assistance?
          </h2>
          <div className="text-center">
            <p className="text-gray-600 mb-4">
              Our staff is here to help with any questions or needs you may have. 
              Whether you need information about church programs, assistance with administrative matters, 
              or have questions about your membership, we're here to serve you.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <a 
                href="/contact" 
                className="bg-church-blue text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors"
              >
                Contact Us
              </a>
              <a 
                href="tel:9722413293" 
                className="bg-gray-200 text-gray-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors"
              >
                Call (972) 241-3293
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default StaffPage;
