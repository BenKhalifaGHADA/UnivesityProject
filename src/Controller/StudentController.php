<?php

namespace App\Controller;

use App\Entity\Student;

use App\Form\RechercheStudentFormType;
use App\Form\StudentType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Serializer;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index()
    {
        //$students=$this->getDoctrine()->getRepository(Student::class)->findAll();
        //$student=$this->getDoctrine()->getRepository(Student::class)->find(2);
       // $student=$this->getDoctrine()->getRepository(Student::class)->findBy(array('lastname' => 'foulen','firstname' => 'ben foulen'),
            //array('lastname' => 'desc'),10, 0);
        //$student=$this->getDoctrine()->getRepository(Student::class)->findOneBy(array('lastname' => 'foulen','firstname' => 'ben foulen'));
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    /*******************************************************
    /**
     *  BEGIN REQUEST QUERYBuilder
     */
    /*******************************************************

    /**
     * @return Response
     * @Route("/showall",name="showallstudent")
     */
    public function showAllStudent(){
        $em=$this->getDoctrine()->getManager();
        $students=$em->getRepository(Student::class)->findAllStudents();
        $studentsNumber=$em->getRepository(Student::class)->showNumberStudents();
        return $this->render('student/AfficheQB.html.twig',
            ['students'=>$students,'numberStudent'=>$studentsNumber]
        );
    }

    /**
     * @param $id
     * @Route("/QueryBuilderSelect/{id}", name="studentById")
     * @return Response
     */
    public function showStudentById($id){
        $em=$this->getDoctrine()->getManager();
        $students=$em->getRepository(Student::class)->showStudentById($id);
        return $this->render('student/AfficheQB.html.twig',
            ['students'=>$students]
        );
    }

    /**
     * @return Response
     * @Route ("/QueryBuilderWithLike", name="studentbufirstandlast")
     */
    public function showStudentByFirstnameAndLastname(){
        $em=$this->getDoctrine()->getManager();
        $students=$em->getRepository(Student::class)->showStudentByFirstname();
        $studentsNumber=$em->getRepository(Student::class)->showNumberStudents();
        return $this->render('student/AfficheQB.html.twig',
            ['students'=>$students,'numberStudent'=>$studentsNumber]
        );
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @Route ("/deleteStudent/{id}",name="delete_student")
     */
    public function deleteStudent($id)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository(Student::class)->find($id);

        if (!$student) {
            throw $this->createNotFoundException(
                'There are no student with the following id: ' . $id
            );
        }
        $em->remove($student);
        $em->flush();
        $studentsNumber=$em->getRepository(Student::class)->showNumberStudents();
        $students=$em->getRepository(Student::class)->findAllStudents();
        return $this->render('student/AfficheQB.html.twig',['numberStudent'=>$studentsNumber,'students'=>$students]);

    }
     /*******************************************************
     /**
      *  END REQUEST QUERYBuilder
      */
    /*******************************************************/

    /*******************************************************
    /**
    *  BEGIN REQUEST DQL
    */
    /*******************************************************/
    /**
     * @param $id
     * @return Response
     * @Route ("/find/{id}",name="findbyId")
     */
    public function findStudentById($id)
    {
        $em=$this->getDoctrine()->getManager();
        $students=$em->getRepository(Student::class)->find($id);
        if(!$students){
            throw $this->createNotFoundException(
                "Auncun étudiant trouvé pour l'identifiant".$id
            );
        }
        return $this->render('student/AfficheDQL.html.twig',
            ['students'=>$students]
        );
    }

    /**
     * @return Response
     * @Route ("/showAll", name="showStudent")
     */
    public function findAllStudent()
    {
        $em=$this->getDoctrine()->getManager();
        $students=$em->getRepository(Student::class)->findAll();
        $studentsNumber=$em->getRepository(Student::class)->showNumberStudents();
        return $this->render('student/AfficheDQLAll.html.twig',
            ['students'=>$students,'numberStudent'=>$studentsNumber]
        );
    }

    /**
     * @return Response
     * @Route ("/showAllSelect", name="showStudent")
     */
    public function findAllStudentWithSelect()
    {
        $em=$this->getDoctrine()->getManager();
        $students=$em->getRepository(Student::class)->findAllStudents();
        $studentsNumber=$em->getRepository(Student::class)->showNumberStudents();
        return $this->render('student/AfficheDQLAll.html.twig',
            ['students'=>$students,'numberStudent'=>$studentsNumber]
        );
    }

    /**
     * @param $firstname
     * @return Response
     * @Route ("/findByFirstname/{firstname}",name="findbyfirstname")
     */
    public function findFirstnameParam($firstname)
    {
        $em=$this->getDoctrine()->getManager();
        $students=$em->getRepository(Student::class)->findFirstnameParameter($firstname);
        $studentsNumber=$em->getRepository(Student::class)->showNumberStudents();
        return $this->render('student/AfficheDQLAll.html.twig',
            ['students'=>$students,'numberStudent'=>$studentsNumber]
        );
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/findStudent",name="findDQL")
     */
    public function findFirstnameParamDate(Request $request)
    {
        $student=new Student();
        $em=$this->getDoctrine()->getManager();
        $students=$em->getRepository(Student::class)->findAll();
        $Form=$this->createForm(RechercheStudentFormType::class,$student);
        $Form->handleRequest($request);
        if($Form->isSubmitted() && $Form->isValid()){
            $firstname=$student->getFirstname();
            $students=$em->getRepository(Student::class)->findFirstnameParameter($firstname);
        }
        return $this->render('student/recherche.html.twig',
            ['students'=>$students,'Form'=>$Form->createView()]
        );

    }


   /*******************************************************
   /**
    *  END REQUEST DQL
    */
    /*******************************************************/

    /****Workshop Relation**********************************/
    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @Route ("/addStudent",name="addStudent")
     */
    public function AddStudent(Request $request)
    {   $student=new Student();
        $Form=$this->createForm(StudentType::class,$student);
        $Form->handleRequest($request);
        if($Form->isSubmitted() && $Form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute('showStudent');

        }
        return $this->render('student/indexRelation.html.twig',
            ['Form'=>$Form->createView()]
        );
    }
}
