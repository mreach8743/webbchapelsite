import React from 'react';
import { Users, Heart, BookOpen, Users2 } from 'lucide-react';

const EldersPage: React.FC = () => {
  const elders = [
    {
      name: "Greg Chandler",
      image: "/images/leadership/elderChandlerGreg.jpg",
      bio: "Greg and his wife Donelle have attended Webb Chapel since 1997. In that time, they have led a Care Group and a Small Group bible study for a number of years. Greg has also served as deacon over missions and adult education, and is part of the A/V team. Donelle was a teacher and coordinator for primary education. Greg has been a database programmer and systems designer for Solomon Associates since 1994. Their children, Garrett and Jara, grew up at Webb Chapel and are currently attending Texas A&M University."
    },
    {
      name: "John Smith",
      image: "/images/leadership/elderSmithJohn.jpg",
      bio: "John has been serving as an elder at Webb Chapel for over 10 years. He and his wife have been active in various ministries and have a heart for shepherding the congregation."
    }
  ];

  return (
    <div className="w-full">
      {/* Hero Section */}
      <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white py-16">
        <div className="container mx-auto px-4">
          <div className="text-center">
            <h1 className="text-4xl md:text-5xl font-bold mb-4">
              Our Shepherds
            </h1>
            <p className="text-xl md:text-2xl text-blue-100">
              Spiritual leaders guiding our congregation
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
                Meet Our Shepherds
              </h2>
              <p className="text-lg text-gray-600">
                Our shepherds (elders) are spiritual leaders who guide and care for our congregation. 
                They provide spiritual oversight, pastoral care, and biblical teaching to help our church 
                grow in faith and love.
              </p>
            </div>
          </div>
        </div>

        {/* Elders Grid */}
        <div className="grid md:grid-cols-2 gap-8 mb-12">
          {elders.map((elder, index) => (
            <div key={index} className="bg-white rounded-lg shadow-lg overflow-hidden">
              <div className="p-6">
                <div className="text-center mb-6">
                  <img 
                    src={elder.image} 
                    alt={elder.name}
                    className="w-48 h-60 object-cover rounded-lg mx-auto mb-4"
                  />
                  <h3 className="text-2xl font-bold text-gray-800 mb-2">
                    {elder.name}
                  </h3>
                </div>
                <p className="text-gray-600 leading-relaxed">
                  {elder.bio}
                </p>
              </div>
            </div>
          ))}
        </div>

        {/* Role of Shepherds */}
        <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white rounded-lg p-8 mb-12">
          <h2 className="text-3xl font-bold text-center mb-8">
            The Role of Shepherds
          </h2>
          
          <div className="grid md:grid-cols-3 gap-8">
            <div className="text-center">
              <Heart className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Pastoral Care</h3>
              <p className="text-blue-100">
                Providing spiritual guidance, counseling, and support to church members
              </p>
            </div>
            
            <div className="text-center">
              <BookOpen className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Biblical Teaching</h3>
              <p className="text-blue-100">
                Ensuring sound doctrine and biblical teaching throughout the congregation
              </p>
            </div>
            
            <div className="text-center">
              <Users2 className="w-12 h-12 mx-auto mb-4" />
              <h3 className="text-xl font-bold mb-3">Church Leadership</h3>
              <p className="text-blue-100">
                Making important decisions and providing direction for the church
              </p>
            </div>
          </div>
        </div>

        {/* Contact Information */}
        <div className="bg-white rounded-lg shadow-lg p-8">
          <h2 className="text-2xl font-bold text-gray-800 mb-6 text-center">
            Contact Our Shepherds
          </h2>
          <div className="text-center">
            <p className="text-gray-600 mb-4">
              If you need spiritual guidance, have questions about the church, or would like to speak with one of our shepherds, please don't hesitate to reach out.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <a 
                href="/contact" 
                className="bg-church-blue text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors"
              >
                Contact Us
              </a>
              <a 
                href="/imnewhere" 
                className="bg-gray-200 text-gray-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors"
              >
                I'm New Here
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default EldersPage;
